<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PrebuiltPcController extends Controller
{
    public function index(Request $request){
        $id = $request->get("id");
        $name = $request->get("name");
        $listItem = Product::where('type',Product::TYPE_PC)
            ->id($id)
            ->name($name)
            ->paginate(10);
        return view('content.prebuiltPC.index',
            [
                'listItem'=>$listItem,
            ]
        );
    }

}
