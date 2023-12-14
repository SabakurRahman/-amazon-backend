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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->string('category')->nullable();
            $table->integer('countInStoke')->nullable();
            $table->string('brand')->nullable();
            $table->float('rating', 3, 1)->nullable();
            $table->integer('numReviews')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
