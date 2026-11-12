<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('freelancer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('headline', 255)->nullable();
            $table->text('bio')->nullable();
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->string('availability', 50)->nullable()->comment('full_time, part_time, contract');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('freelancer_profiles');
    }
};

