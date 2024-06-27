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
        Schema::create('surf_maps', function (Blueprint $table) {
            $table->id();
            $table->string('Name', length:255);
            $table->binary('Image');
            $table->string('Status', length:40);
            $table->string('Tier', length:4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surf_maps');
    }
};
