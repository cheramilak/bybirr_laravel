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
        Schema::create('virtual_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('card_number')->unique();
            $table->string('cardholder_name');
            $table->string('expiration_date'); // MM/YY format
            $table->string('cvv');
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->enum('status', ['Active', 'Inactive', 'Blocked'])->default('Active');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virtual_cards');
    }
};
