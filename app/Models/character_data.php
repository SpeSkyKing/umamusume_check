<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class character_data extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'character_data';

    public $incrementing = false;

    const UPDATED_AT = null;

    const CREATED_AT = null;

    protected $guarded = ["name"];

    protected $attributes = [
        "name"  => "あああ",                       
        "Grass_Suitability" => "G",             
        "Dirt_Suitability" => "G",
        "Sprint_Suitability" => "G",                      
        "Mile_Suitability" => "G",
        "Classic_Suitability" => "G",
        "Stayer_Suitability" => "G",  
        "Lead_Pace_Suitability" => "G",     
        "Front_Runner_Suitability" => "G",    
        "Hold_Up_Runner_Suitability" => "G",
        "Late_Charge_Drive_Suitability" => "G",
        "Race_Chack_Field" => "NULL",
    ];
}
