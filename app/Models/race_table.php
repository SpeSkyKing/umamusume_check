<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class race_table extends Model
{
    use HasFactory;

    protected $primaryKey = 'race_id';

    protected $table = 'race_table';

    public $incrementing = false;

    const UPDATED_AT = null;

    const CREATED_AT = null;

    protected $guarded = ["race_id"];

    protected $attributes = [                       
        "racename" => "あああああ",
        "ground" => 1,
        "distance" => "中距離",           
        "rank" => "3",
        "date" => "99",
        "is_First" => "前半",
        "IS_junior" => 0,                  
        "IS_classic" => 0,
        "IS_senior" => 0,
    ];
}
