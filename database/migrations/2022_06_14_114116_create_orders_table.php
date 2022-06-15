<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->bigInteger('total_item')->default(0);
            $table->bigInteger('total_price')->default(0);
            $table->bigInteger('delivery_price')->default(0);
            $table->bigInteger('bills_price')->default(0);
            $table->bigInteger('change_price')->default(0);
            $table->string('store_name')->nullable();
            $table->string('table_name')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('payment_name')->nullable();
            $table->string('shipment_name')->nullable();
            $table->boolean('payment_status');
            $table->string('proof_of_payment')->nullable();
            $table->string('status');
            $table->string('type');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            // $table->foreign('config_id')->references('id')->on('partner_configurations');
            // $table->foreign('table_id')->references('id')->on('tables');
            // $table->foreign('customer_id')->references('id')->on('customers');
            // $table->foreign('address_id')->references('id')->on('addresses');
            // $table->foreign('shipment_id')->references('id')->on('shipments');
            // $table->foreign('payment_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
