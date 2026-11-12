<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('category', 100)->nullable()->after('description');
            $table->string('experience_level', 50)->nullable()->after('budget');
            $table->string('work_arrangement', 50)->nullable()->after('experience_level');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['category', 'experience_level', 'work_arrangement']);
        });
    }
};

