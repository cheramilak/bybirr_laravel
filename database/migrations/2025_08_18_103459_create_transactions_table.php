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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->decimal('rate');
            $table->decimal('total')->virtualAs('rate*amount');
            $table->enum('status',['Pending','Approve','Faild'])->default('Pending');
            $table->string('transactionId')->unique();
            $table->string('image');
            $table->enum('type',['Card order','Deposit']);
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('user_id');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
