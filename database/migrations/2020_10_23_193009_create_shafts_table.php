<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShaftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shafts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shaft_id')->nullable();
            $table->unsignedInteger('automat_id');
            $table->unsignedInteger('product_id');
            $table->boolean('active')->default(true);
            $table->integer('measuredShaftLength')->default(0);
            $table->integer('capacity')->default(0);
            $table->integer('level')->default(0);
            $table->tinyInteger('errorCode')->default(0);
            $table->timestamps();
        });

        Schema::table('shafts', function($table) {
            $table->foreign('automat_id')->references('id')->on('automats');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shafts');
    }
}
