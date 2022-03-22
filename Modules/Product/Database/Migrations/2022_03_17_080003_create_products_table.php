<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*Product ID – primary key represented with underline
Code
Name
Unit Price
Unit in Stock
Discount Percentage
Re Order Level
Category ID – foreign key
Unit ID – foreign key
User ID – foreign key */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('product_name');
            $table->integer('product_stock');
            $table->string('image');
            $table->float('unit_price');
            $table->integer('dicount_percentage')->nullable();
            $table->integer('Category_id')->nullable();
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
        Schema::dropIfExists('products');
    }
};
