<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('brand');
            $table->string('image');
            $table->integer('stock');
            $table->timestamps();
        });

        Schema::create('wished_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('shopping_list_id');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('shopping_list_id')->references('id')->on('shopping_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wished_products');
        Schema::dropIfExists('products');
    }
}
