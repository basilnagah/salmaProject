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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('mediaable_type');
            $table->unsignedBigInteger('mediaable_id');
            $table->string('filename');
            $table->string('filetype')->default('image');
            $table->string('type');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['mediaable_id', 'mediaable_type']);

            //foreign keys
            $table->foreign('color_id')->references('id')->on('colors');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
