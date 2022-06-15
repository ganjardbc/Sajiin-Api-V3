<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_plans', function (Blueprint $table) {
            $table->id();
            $table->string('order_plan_id')->unique();
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('total_price')->default(0);
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_plans');
    }
}
