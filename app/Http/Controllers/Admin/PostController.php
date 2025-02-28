<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\AddPostRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{

    protected function fillDataToPost($item, $input, $is_create) : void
    {
        $item["title"] = $input["name"] ?? "";
        $item["slug"] = $input["slug"] ?? Str::slug($item["name"]);
        $item["description"] = $input["description"] ?? "";
        $item["content"] = $input["content"] ?? "";
        $item["seo_title"] = $input["seo_title"] ?? "";
        $item["seo_keywords"] = $input["seo_keywords"] ?? "";
        $item["seo_description"] = $input["seo_description"] ?? "";
        $item["images"] = $input["images"] ?? "";
        $item["type"] = Post::TYPE_POST;
        $item["author_id"] = Auth::id();
        if ($is_create)
        {
            $item["views"] = 0;
            $item["rating_number"] = 0;
            $item["rating_value"] = 0;
        }
        $item->save();
    }
    public function index(): Factory|View|Application
    {
        return view('content.post.index',[
            "posts" =>
                Post::where('type', Post::TYPE_POST)->paginate(50),
        ]);

    }

    public function add(): Factory|View|Application
    {
        return view("content.post.add");
    }
    public function store(AddPostRequest $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $item = new Post();
        $this->fillDataToPost($item, $input, true);
        return response()->json(['success' => true, 'message' => __('create success'),
            'url' => route('post.index')]);
    }

    public function edit($id): Factory|View|Application|RedirectResponse
    {
        $post = Post::find($id);
        if (!$post) return redirect()->back();
        return view("content.post.edit",[
            "item" => $post,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $post = Post::find($id);
        if (!$post) return redirect()->back();

        $input = $request->all();
        $this->fillDataToPost($post, $input, false);
        return redirect()->route("post.index");
    }

    public function destroy($id): RedirectResponse
    {
        $post = Post::find($id);
        if (!$post) return redirect()->back();
        $post->delete();
        return redirect()->route("post.index");
    }
}
