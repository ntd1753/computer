<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected function fillDataToBanner($item, $input) : void
    {
        $item["title"] = $input["name"] ?? "";
        $item['image']=$input["image"];
        $item['link']=$input['link'];
        $item['position']=$input['position'];
        $item['status']=$input['status'];
        $item->save();
    }
    public function index(){
        return view('content.banner.index',
            ['banners'=>Banner::paginate(5)
            ]);
    }
    public function add(){
        return view('content.banner.add');
    }
    public function store(Request $request){
        $input=$request->all();
        $item=new Banner();
        $this->fillDataToBanner($item,$input);
        return response()->json(['success' => true, 'message' => __('update success'),
            'url' => route('banner.index')]);

    }
    public function edit($id){
        return view('content.banner.edit',['item'=>Banner::find($id)]);
    }
    public function update($id,Request $request){
        $input=$request->all();
        $item=Banner::find($id);
        $this->fillDataToBanner($item,$input);
        return redirect()->route("banner.index");
    }
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $banner = Banner::find($id);
        if (!$banner) return redirect()->back();
        $banner->delete();
        return redirect()->route("banner.index");
    }
}
