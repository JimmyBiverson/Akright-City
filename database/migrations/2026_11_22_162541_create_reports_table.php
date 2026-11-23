<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->string('category');
            $table->string('title');
            $table->text('path')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['year', 'category', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
