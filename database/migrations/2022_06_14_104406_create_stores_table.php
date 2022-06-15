<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store_id')->unique();
            $table->string('image')->nullable();
            $table->string('name');
            $table->longText('about')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('open_day')->nullable();
            $table->string('close_day')->nullable();
            $table->string('open_time')->nullable();
            $table->string('close_time')->nullable();
            $table->boolean('is_available');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->unsignedBigInteger('merchant_id');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('merchants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
