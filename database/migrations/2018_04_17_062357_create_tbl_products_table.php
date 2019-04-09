<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProductsTable extends Migration
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
            $table->string('slug');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('description')->nullable()->default(null);
            $table->float('price');
            $table->string('image')->nullable()->default(null);
            $table->string('size')->nullable()->default(null);
            $table->string('color')->nullable()->default(null);
            $table->integer('status');
            $table->integer('featured');
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
        Schema::dropIfExists('tbl_products');
    }
}
