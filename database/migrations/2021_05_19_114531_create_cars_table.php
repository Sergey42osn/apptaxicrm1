<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id()->autoIncrement();
			$table->integer('id_user');
			$table->integer('id_name');
            $table->integer('id_model');
            $table->integer('id_brand');
            $table->integer('id_category');
			$table->integer('id_color');
            $table->boolean('is_working')->default(0);
            $table->boolean('is_free')->default(1);
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
        Schema::dropIfExists('cars');
    }
}
