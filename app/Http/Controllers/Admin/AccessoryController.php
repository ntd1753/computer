<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accessory;
use Yajra\DataTables\Facades\DataTables;

class AccessoryController extends Controller
{
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

}
