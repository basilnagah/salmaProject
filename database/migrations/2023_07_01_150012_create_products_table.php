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
            $table->string('name');
            $table->string('desc');
            $table->string('category');
            $table->decimal('price');
            $table->decimal('salePrice')->nullable();
            $table->decimal('sale')->nullable();
            $table->string('quantity');
            $table->string('image1',255)->nullable();
            $table->string('image2',255)->nullable();
            $table->string('image3',255)->nullable();
            $table->string('image4',255)->nullable();
            $table->string('image5',255)->nullable();
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
