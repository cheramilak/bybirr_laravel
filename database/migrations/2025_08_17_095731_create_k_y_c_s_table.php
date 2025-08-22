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
        Schema::create('k_y_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('fName');
            $table->string('lName');
            $table->string('country')->default('Ethiopia');
            $table->string('idType')->default('PASSPORT');
            $table->string('idNumber');
            $table->string('phone');
            $table->string('city');
            $table->string('address');
            $table->string('zipCode');
            $table->string('line1');
            $table->string('houseNumber');
            $table->string('photo');
            $table->string('idFront');
            $table->string('idBack');
            $table->string('email')->unique();
            $table->date('bod');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->unsignedBigInteger('user_id');
            $table->string('reason')->nullable();
            $table->uuid('uuid')->unique();
            $table->string('customerId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_y_c_s');
    }
};
