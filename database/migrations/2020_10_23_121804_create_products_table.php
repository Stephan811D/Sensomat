<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productType_id');
            $table->string('productName', 100);
            $table->decimal('price', 6, 2);
            $table->char('color', 6);
            $table->boolean('active')->default('1');
            $table->timestamps();
        });

        Schema::table('products', function($table) {
            $table->foreign('productType_id')->references('id')->on('productTypes');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

