<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerCase extends Model
{
    use HasFactory;
    protected $table = 'computer_cases';
    protected $fillable = [
        'case_type',
        'material',
        'mainboard_size',
        'color'
    ];
    public function detail(){
        return $this->hasOne(Accessory::class);
    }

    public static function fillDataComputerCase($input,$computerCase):void{
        $computerCase->case_type = $input['case_type'];
        $computerCase->material = $input['material'];
        $computerCase->mainboard_size = $input['mainboard_size'];
        $computerCase->color = $input['color'];
        $computerCase->save();
    }
}
