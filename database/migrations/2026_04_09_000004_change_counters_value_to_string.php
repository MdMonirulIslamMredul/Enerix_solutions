<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('counters', function (Blueprint $table) {
            $table->string('value')->change();
        });
    }

    public function down(): void
    {
        Schema::table('counters', function (Blueprint $table) {
            $table->unsignedInteger('value')->change();
        });
    }
};
