<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAccessoryRequest;
use App\Models\Accessory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ComputerCase;
use App\Models\CPU;
use App\Models\Fan;
use App\Models\MainBoard;
use App\Models\Post;
use App\Models\Product;
use App\Models\PSU;
use App\Models\Ram;
use App\Models\Storage;
use App\Models\VGA;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    private function getCategories($model_type){
        return Category::where('type','=', $model_type)->whereNull('parent_id')->with('subCategories')->get();
    }

    protected function createDetailAccessory($accessory_type)
    {
        switch ($accessory_type) {
            case Accessory::TYPE_CPU:
                $accessoryDetail = new CPU();
                break;
            case Accessory::TYPE_RAM:
                $accessoryDetail = new Ram();
                break;
            case Accessory::TYPE_MAINBOARD:
                $accessoryDetail = new MainBoard();
                break;
            case Accessory::TYPE_CASE:
                $accessoryDetail = new ComputerCase();
                break;
            case Accessory::TYPE_PSU:
                $accessoryDetail = new PSU();
                break;
            case Accessory::TYPE_STORAGE:
                $accessoryDetail = new Storage();
                break;
            case Accessory::TYPE_FAN:
                $accessoryDetail = new Fan();
                break;
            case Accessory::TYPE_VGA:
                $accessoryDetail = new VGA();
                break;
        }
        return $accessoryDetail;
    }
    protected function filterProduct($input, $accessory, $post, $product)
    {
        // Populate the existing product instance with the provided data
        $product->name = $input['name'];
        $product->slug = Str::slug($input['name']);
        $product->type = Product::TYPE_ACCESSORY; // Adjust according to product type
        $product->brand_id = $input['brand_id'];
        $product->cost = $input['cost'];
        $product->price = $input['price'];
        $product->discount_type = $input['discount_type'] ?? null; // Default to null if not provided
        $product->discount_value = $input['discount_value'] ?? null; // Default to null if not provided
        $product->category_id = $input['category_id'];
        $product->detail_id = $accessory->id; // Link product to accessory
        $product->post_id = $post->id; // Link product to post
        // Save the product
        $product->save();
        // Return the updated product
        return $product;
    }

    public function index($accessory_type, Request $request){
        $id = $request->get("id");
        $name = $request->get("name");
        $brand = $request->get("brand");
        $accessories = Accessory::where('type',strtoupper($accessory_type))
            ->id($id)
            ->name($name)
            ->brand($brand)
            ->paginate(10);
        return view('content.accessory.index',
            [
                'accessories'=>$accessories,
                'accessoryType'=>$accessory_type
            ]
        );
    }

    public function add($accessory_type){
        $accessory_type=strtolower($accessory_type);
        return view("content.accessory.add",
            [
                'accessoryType'=>$accessory_type,
                'categories' => $this->getCategories(Category::TYPE_PRODUCT),
                'brands' => Brand::all(),
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function store(AddAccessoryRequest $request, $accessory_type)
    {
        $validated = $request->all();
        $accessory_type=strtoupper($accessory_type);
        $accessoryDetail = $this->createDetailAccessory($accessory_type);
        $accessoryDetail=Accessory::fillDetailAccessoryByType($accessory_type,$validated,$accessoryDetail);
        $post = new Post();
        $post = Post::fillDataPost($validated,$post, false);
        $post->type = Post::TYPE_PRODUCT;
        $post->save();
        $accessory = new Accessory();

        $accessory = Accessory::fillDataAccessory($validated,$accessory_type, $accessory, $accessoryDetail);
        $product = new Product();

        $product = $this->filterProduct($validated,$accessory,$post,$product);
        if ($request->has('images')) {
            $images = [];
            foreach ($request->get('images') as $item) {
                $images[] = $item;
            }

            $product->images = json_encode($images);
        }
        $product->save();

        return response()->json(['success' => true, 'message' => __('create success'),
            'url' => route('accessory.index',['accessory_type'=>$accessory_type])]);
    }
    public function edit($accessory_type, $id){
        return view("content.accessory.edit",
            [
                'accessoryType'=>$accessory_type,
                'categories' =>  $this->getCategories(Category::TYPE_PRODUCT),
                'brands' => Brand::all(),
                'accessory' => Accessory::find($id),
            ]
        );
    }
    public function update(AddAccessoryRequest $request, $accessory_type, $id)
    {
        $validated = $request->all();
        $accessory_type=strtoupper($accessory_type);
        $accessory = Accessory::find($id);
        $accessoryDetail=Accessory::fillDetailAccessoryByType($accessory_type,$validated, $accessory->detail);
        $post = Post::find($accessory->product->post_id);
        $post = Post::fillDataPost($validated,$post, false);
        $post->type = Post::TYPE_PRODUCT;
        $post->save();
        $accessory = Accessory::fillDataAccessory($validated,$accessory_type, $accessory, $accessoryDetail);
        $product = Product::find($accessory->product->id);

        $product = $this->filterProduct($validated,$accessory,$post,$product);
        if ($request->has('images')) {
            $images = [];
            foreach ($request->get('images') as $item) {
                $images[] = $item;
            }
            $product->images = json_encode($images);
        }
        $product->save();

        return response()->json(['success' => true, 'message' => __('update success'),
            'url' => route('accessory.index',['accessory_type'=>$accessory_type])]);
    }
    public function destroy($accessory_type, $id){
        $accessory = Accessory::find($id);
        $accessory->product->delete();

        return redirect()->route('accessory.index',['accessory_type'=>$accessory_type]);
    }

}
