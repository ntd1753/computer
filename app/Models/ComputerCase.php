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
}
