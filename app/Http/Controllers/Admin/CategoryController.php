<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    private function fillData($item, $input): void
    {
        $item["parent_id"] = $input["parent_id"];
        $item["name"] = $input["name"];
        $item["slug"] = $input["slug"] ?? Str::slug($input["name"]);
        $item["icon"] = $input["image"] ?? null;
        $item->save();
    }
    public function index(Request $request): Factory|View|Application
    {
        $id = $request->get("id");
        $name = $request->get("name");
        if (empty($request->all())){
            $categories =Category::where('parent_id','=',null)->with('subCategories')->paginate(10);
        }else{
            $categories =Category::id($id)->name($name)->with('subCategories')->paginate(10);
        }
        return view("content.category.index",[
            "categories" => $categories,
        ]);
    }
    public function add(): Factory|View|Application
    {
        $categories =Category::where('parent_id','=',null)->with('subCategories')->get();
        return view("content.category.add",[
            "categories" => $categories,
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        $category = new Category();
        $this->fillData($category, $input);

        return redirect()->route("category.index");
    }

    public function edit($id): Factory|View|Application|RedirectResponse
    {
        $categories =Category::where('parent_id','=',null)->with('subCategories')->get();

        $item = Category::find($id);
        if (!$item) return redirect()->back();

        return view('content.category.edit', [
            "item"=>$item,
            "categories" => $categories,
        ]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        $item = Category::find($id);
        if (!$item) return redirect()->back();
        $input = $request->all();
        $this->fillData($item, $input);
        return redirect()->route("category.index");
    }
    public function destroy($id): RedirectResponse
    {
        $item = Category::find($id);
        if (!$item) return redirect()->back();
        $item->delete();
        return redirect()->route("category.index");
    }
}
