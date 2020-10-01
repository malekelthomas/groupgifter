<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPickedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_picked', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('num_picked');
            $table->foreignId('user_id')->constrained(); //uses convention to find table and column name referenced
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_picked');
    }
}
