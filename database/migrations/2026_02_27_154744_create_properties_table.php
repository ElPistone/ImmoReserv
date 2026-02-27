<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price_per_night', 10, 2);
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->integer('bedrooms')->default(1);
            $table->integer('bathrooms')->default(1);
            $table->integer('max_guests')->default(2);
            $table->string('image_url')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            
            // Index pour les recherches fréquentes
            $table->index('city');
            $table->index('is_available');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};