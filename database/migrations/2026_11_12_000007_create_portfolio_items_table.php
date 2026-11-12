<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_profile_id')->constrained('freelancer_profiles')->cascadeOnDelete();
            $table->string('title');
            $table->string('type', 50)->default('project')->comment('project, certificate, link');
            $table->text('description')->nullable();
            $table->string('url', 2048)->nullable();
            $table->string('file_path', 2048)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};

