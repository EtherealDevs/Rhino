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
            $table->integer('total');

            $table->foreignId('delivery_service_id')->references('id')->on('delivery_services')->nullable();
            $table->string('delivery_price')->nullable();
            $table->foreignId('address_id')->references('id')->on('addresses')->nullable();
            
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
