<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_endorsements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_skill_id')->constrained('user_skills')->cascadeOnDelete();
            $table->foreignId('endorsed_by_id')->constrained('users')->cascadeOnDelete();
            $table->text('note')->nullable();
            $table->unique(['user_skill_id', 'endorsed_by_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_endorsements');
    }
};

