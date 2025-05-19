<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('level', ['Beginner', 'Intermediate', 'Advanced']);
            $table->enum('team_type', ['Single', 'Double']);
            $table->integer('max_teams')->default(64);
            $table->integer('points')->default(20);
            $table->enum('event_type', ['Tournament', 'League', 'Friendly', 'Other']);
            $table->text('event_detail')->nullable();
            $table->enum('shuttle_type', ['feather', 'nylon']);
            $table->date('date');
            $table->string('location');
            $table->boolean('complete_results')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
