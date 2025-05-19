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
        Schema::create('players', function (Blueprint $table) {
            $table->id(); 
            $table->string('first_name');
            $table->string('surname');
            $table->string('preferred_name')->nullable();
            $table->date('year_of_birth');
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('registered_with_badminton_england')->default(0);
            $table->string('registration_number')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
