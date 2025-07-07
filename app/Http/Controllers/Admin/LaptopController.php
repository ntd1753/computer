<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PC\AddPcRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\LaptopAndPrebuiltPc;
use App\Models\Post;
use App\Models\Product;
use App\Traits\FillDataProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LaptopController extends Controller
{
    use FillDataProduct;
    private function getCategories($model_type){
        return Category::where('type','=', $model_type)->whereNull('parent_id')->with('subCategories')->get();
    }
    /**
     * Cập nhật thông tin chi tiết
     *
     * @param LaptopAndPrebuiltPc $item
     * @param array $input
     * @return LaptopAndPrebuiltPc
     */
    protected function fillDataPreBuiltPCDetail(LaptopAndPrebuiltPc $item, array $input): LaptopAndPrebuiltPc
    {
        $data = [
            'product_type'  => Arr::get($input, 'product_type', LaptopAndPrebuiltPc::TYPE_LAPTOP),
            'screen_size'   => Arr::get($input, 'screen_size'),
            'cpu'           => Arr::get($input, 'cpu'),
            'ram'           => Arr::get($input, 'ram'),
            'ram_memory'    => Arr::get($input, 'ram_memory', 'DDR4'),
            'battery_life'  => Arr::get($input, 'battery_life'),
            'vga'           => Arr::get($input, 'vga'),
            'mainboard'     => Arr::get($input, 'mainboard'),
            'hdd_size'      => Arr::get($input, 'hdd_size'),
            'ssd_size'      => Arr::get($input, 'ssd_size'),
            'data_sheet'    => Arr::get($input, 'dataSheet'),
        ];
        $data = array_filter($data, fn($v) => $v !== null && $v !== '');
        $item->fill($data)->save();
        $item->data_sheet = $input['dataSheet'] ?? '';
        $item->save();
        return $item;
    }

    protected function addImage($input, Product $product)
    {
        if ($input->has('images')) {
            $images = [];
            foreach ($input->get('images') as $item) {
                $images[] = $item;
            }
            $product->images = json_encode($images);
        }
        $product->save();
    }
    public function index(Request $request){
        $id = $request->get("id");
        $name = $request->get("name");
        $listItem = Product::where('type',Product::TYPE_LAPTOP)
            ->id($id)
            ->name($name)
            ->paginate(10);
        return view('content.laptop.index',
            [
                'listItem'=>$listItem,
            ]
        );
    }
    public function add()
    {

        return view('content.laptop.add',[
            'categories' => $this->getCategories(Category::TYPE_PRODUCT),
            'brands' => Brand::all(),
        ]);
    }
    function store(AddPcRequest $request): \Illuminate\Http\JsonResponse
    {
        $post = new Post();
        $post = Post::fillDataPost($request,$post, false);
        $prebuiltPCDetail = new LaptopAndPrebuiltPc();
        $prebuiltPCDetail = $this->fillDataPreBuiltPCDetail($prebuiltPCDetail, $request->all());
        $product = new Product();
        $product = $this->fillProduct($request->all(), $prebuiltPCDetail, $post, $product, Product::TYPE_LAPTOP);
        $this->addImage($request, $product);
        return response()->json(['success' => true, 'message' => __('update success'),
            'url' => route('laptop.index')]);
    }
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $laptop = Product::findOrFail($id);
        $laptopDetail = $laptop->detail;
        return view('content.laptop.edit', [
            'laptop' => $laptop,
            'laptopDetail' => $laptopDetail,
            'categories' => $this->getCategories(Category::TYPE_PRODUCT),
            'brands' => Brand::all(),
        ]);
    }
    public function update(AddPcRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $prebuiltPC = Product::findOrFail($id);
        $post = $prebuiltPC->post;
        $post = Post::fillDataPost($request,$post, false);
        $prebuiltPCDetail = $prebuiltPC->detail;
        $prebuiltPCDetail = $this->fillDataPreBuiltPCDetail($prebuiltPCDetail, $request->all());
        $product = $this->fillProduct($request->all(), $prebuiltPCDetail, $post, $prebuiltPC, Product::TYPE_LAPTOP);
        $this->addImage($request, $product);
        return response()->json(['success' => true, 'message' => __('update success'),
            'url' => route('laptop.index')]);
    }
    public function destroy($id)
    {
        $prebuiltPC = Product::findOrFail($id);
        $prebuiltPC->delete();

        return redirect()->route('laptop.index');
    }

}
