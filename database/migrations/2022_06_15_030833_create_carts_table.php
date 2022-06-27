<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_id')->unique();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('discount')->default(0);
            $table->integer('quantity')->default(0);
            $table->bigInteger('subtotal')->default(0);
            $table->string('product_image')->nullable();
            $table->string('product_name');
            $table->string('product_detail')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
