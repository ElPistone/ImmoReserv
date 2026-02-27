<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BookingStatus;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('guests')->default(1);
            $table->decimal('total_price', 10, 2);
            
            // Enum MySQL avec les valeurs "confirmée", "en-cours", "annulée"
            $table->enum('status', [
                BookingStatus::CONFIRMED->value,  // "confirmée"
                BookingStatus::PENDING->value,    // "en-cours"
                BookingStatus::CANCELLED->value   // "annulée"
            ])->default(BookingStatus::PENDING->value); // Par défaut "en-cours"
            
            $table->text('special_requests')->nullable();
            $table->timestamps();
            
            $table->index('start_date');
            $table->index('end_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};