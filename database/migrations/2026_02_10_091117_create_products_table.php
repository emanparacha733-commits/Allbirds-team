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
            $table->string('name');       // Product name
            $table->string('image');      // Image file path
            $table->string('category');   // e.g., men, women, socks, apparel
            $table->decimal('price', 8, 2)->nullable(); // Optional price
            $table->boolean('is_new')->default(false); // Optional NEW label
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
