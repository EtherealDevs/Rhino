<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('payment_method_id')->references('id')->on('payment_methods');
            $table->integer('total')->nullable();

            $table->foreignId('delivery_service_id')->nullable()->references('id')->on('delivery_services');
            $table->string('delivery_price')->nullable();
            $table->foreignId('address_id')->nullable()->references('id')->on('addresses');
            
            $table->foreignId('order_status_id')->references('id')->on('order_statuses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
