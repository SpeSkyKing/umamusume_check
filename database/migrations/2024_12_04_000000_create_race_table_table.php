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
        Schema::create('race_table', function (Blueprint $table) {
            $table->string("racename");
            $table->boolean("ground");
            $table->string("distance");          
            $table->string("rank");
            $table->string("date");
            $table->string("is_First");
            $table->boolean("IS_junior");               
            $table->boolean("IS_classic");
            $table->boolean("IS_senior");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_table');
    }
};
