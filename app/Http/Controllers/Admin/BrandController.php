<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    function index(Request $request){
        $name = $request->get("name");
        $id = $request->get("id");
        $brands=Brand::name($name)->id($id)->paginate(10);
        return view('content.brand.index',["brands"=>$brands]);
    }
    function add(){
        return view('content.brand.add');
    }
    public function store(BrandRequest $request){
        $input = $request->all();
        $brand = new Brand();
        $brand["name"] = strtoupper($input["name"]);
        $brand["logo"] = $input["image"] ?? "";
        $brand->save();
        return redirect()->route("brand.index");
    }
    function edit($id){
        $brand=Brand::find($id);
        return view('content.brand.edit',['brand'=>$brand]);
    }
    public function update(BrandRequest $request, $id){
        $brand = Brand::find($id);

        if($brand){
            $input = $request->all();
            $brand["name"] = strtoupper($input["name"]) ?? "";
            $brand["logo"] = $input["image"] ?? $brand["logo"];
            $brand->save();
        }
        return redirect()->route("brand.index");
    }
    public function destroy($id){
        $item = Brand::find($id);
        if($item){
            $item->delete();
        }
        return redirect()->route("brand.index");
    }
}
