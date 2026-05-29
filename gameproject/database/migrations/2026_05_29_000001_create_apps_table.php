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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon_url')->nullable();
            $table->string('download_url');
            $table->string('bonus_amount')->default('₹0');
            $table->string('min_withdrawal')->default('₹100');
            $table->float('rating')->default(4.5);
            $table->string('votes')->default('10K');
            $table->string('size')->default('50');
            $table->text('intro_text')->nullable();
            $table->text('about_text')->nullable();
            $table->json('features')->nullable();
            $table->json('download_steps')->nullable();
            $table->boolean('is_new')->default(false);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
