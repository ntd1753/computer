<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAccessoryRequest;
use App\Models\Accessory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AccessoryController extends Controller
{
    protected function filterProduct($input, $accessory, $post, $product)
    {
        // Populate the existing product instance with the provided data
        $product->name = $input['name'];
        $product->slug = Str::slug($input['name']);
        $product->type = Product::TYPE_ACCESSORY; // Adjust according to product type
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

    public function index($accessory_type){
        $accessories=Accessory::where('type',strtoupper($accessory_type))->paginate(10);
        return view('content.accessory.index',
            [
                'accessories'=>$accessories,
                'accessoryType'=>$accessory_type
            ]
        );
    }
    public function search($accessory_type){

    }
    public function add($accessory_type){
        $accessory_type = strtolower($accessory_type);
        return view("content.accessory.add",
            [
                'accessoryType'=>$accessory_type,
                'categories' => (new \App\Models\Category)->getCategoriesWithSub(),
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
        $accessoryDetail= new Accessory();
        $accessoryDetail=Accessory::fillDetailAccessoryByType($accessory_type,$validated,$accessoryDetail);
        $post = new Post();
        $post = Post::fillDataPost($validated,$post);
        $accessory = new Accessory();

        $accessory = Accessory::fillDataAccessory($validated,$accessory_type, $accessory, $accessoryDetail);
        $product = new Product();

        $product = $this->filterProduct($validated,$accessory,$post,$product);
        if ($request->has('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('product_images', 'public');  // Lưu ảnh vào thư mục 'product_images'
            }
            // Lưu danh sách hình ảnh dưới dạng JSON vào database
            $product->images = json_encode($images);
            $product->save();
        }

        return response()->json(['success' => true, 'message' => __('create success'),
            'url' => route('accessory.index',['accessory_type'=>$accessory_type])]);
    }
    public function edit($accessory_type, $id){
        return view("content.accessory.edit",
            [
                'accessoryType'=>$accessory_type,
                'categories' =>  Category::getCategoriesWithSub(),
                'brands' => Brand::all(),
                'accessory' => Accessory::find($id),
            ]
        );
    }

}
