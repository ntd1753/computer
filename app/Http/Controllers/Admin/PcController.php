<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomPC\AddCustomPCRequest;
use App\Models\Accessory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CustomPc;
use App\Models\Fan;
use App\Models\Post;
use App\Models\Product;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PcController extends Controller
{
    protected function filterProduct($input, $customPC, $post, $product)
    {
        $product->name = $input['name'];
        $product->slug = $input['slug'] ??Str::slug($input['name']);
        $product->type = Product::TYPE_PC;
        $product->cost = $input['cost'];
        $product->price = $input['price'];
        $product->discount_type = $input['discount_type'] ?? null;
        $product->discount_value = $input['discount_value'] ?? null;
        $product->category_id = $input['category_id'];
        $product->detail_id = $customPC->id;
        $product->post_id = $post->id;
        $product->save();
        return $product;
    }
    protected function fillDetailCustomPC($input, $customPC)
    {
        $customPC->cpu_id = $input['cpu_id'];
        $customPC->ram_id = $input['ram_id'];
        $customPC->mainboard_id = $input['mainboard_id'];
        $customPC->vga_id = $input['vga_id'];
        $customPC->psu_id = $input['psu_id'];
        $customPC->case_id = $input['case_id'];
        $customPC->storage_id = $input['storage_id'];
        $customPC->fan_id = $input['fan_id'];
        $customPC->save();
        return $customPC;
    }
    public function index(Request $request){
        $id = $request->get("id");
        $name = $request->get("name");
        $customPCs = Product::where('type',Product::TYPE_CUSTOM_PC)
            ->id($id)
            ->name($name)
            ->paginate(10);
        return view('content.customPC.index',
            [
                'customPCs'=>$customPCs,
            ]
        );
    }

    public function add(){
        $cpus = Accessory::getProductByType(Accessory::TYPE_CPU);
        $rams = Accessory::getProductByType(Accessory::TYPE_RAM);
        $mainboards = Accessory::getProductByType(Accessory::TYPE_MAINBOARD);
        $vgas = Accessory::getProductByType(Accessory::TYPE_VGA);
        $psus = Accessory::getProductByType(Accessory::TYPE_PSU);
        $cases = Accessory::getProductByType(Accessory::TYPE_CASE);
        $SSD = Storage::getStorageType(Storage::TYPE_SSD);
        $HDD = Storage::getStorageType(Storage::TYPE_HDD);
        $airFans = Fan::getFanType(Fan::TYPE_AIRFAN);
        $AIOFans = Fan::getFanType(Fan::TYPE_AIOFAN);
        $caseFans = Fan::getFanType(Fan::TYPE_CASEFAN);
        return view("content.customPC.add",
            [
                'categories' => Category::getCategoriesWithSub(),
                'brands' => Brand::all(),
                'cpus' => $cpus,
                'rams' => $rams,
                'mainboards' => $mainboards,
                'vgas' => $vgas,
                'psus' => $psus,
                'cases' => $cases,
                'SSDs' => $SSD,
                'HDDs' => $HDD,
                'airFans' => $airFans,
                'AIOFans' => $AIOFans,
                'caseFans' => $caseFans,


            ]
        );
    }
    public function store(AddCustomPCRequest $request){
        $post = new Post();
        $post = Post::fillDataPost($request,$post, false);
        $customPC = new CustomPc();
        $customPC = $this->fillDetailCustomPC($request,$customPC);
        $product = new Product();
        $product = $this->filterProduct($request,$customPC,$post,$product);

        return response()->json(['success' => true, 'message' => __('create success'),
            'url' => route('customPC.index')]);
    }

}
