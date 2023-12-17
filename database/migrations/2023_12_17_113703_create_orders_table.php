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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('order_address')->nullable();
            $table->float('shipping_price')->nullable();
            $table->float('tax_price')->nullable();
            $table->float('total_price')->nullable();
            $table->string('payment_method')->nullable();
            $table->tinyInteger('payment_status')->nullable();
            $table->date('paid_at')->nullable();
            $table->tinyInteger('order_status')->nullable();
            $table->date('delivered_at')->nullable();
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
