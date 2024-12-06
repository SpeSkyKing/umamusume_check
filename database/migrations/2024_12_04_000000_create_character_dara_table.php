<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_data', function (Blueprint $table) {
            $table->unique()->string("name");
            $table->string("Grass_Suitability");    
            $table->string("Dirt_Suitability");
            $table->string("Sprint_Suitability");                    
            $table->string("Mile_Suitability");
            $table->string("Classic_Suitability");
            $table->string("Stayer_Suitability");  
            $table->string("Lead_Pace_Suitability");     
            $table->string("Front_Runner_Suitability");    
            $table->string("Hold_Up_Runner_Suitability");
            $table->string("Late_Charge_Drive_Suitability");
            $table->string("Race_Chack_Field");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_data');
    }
};
