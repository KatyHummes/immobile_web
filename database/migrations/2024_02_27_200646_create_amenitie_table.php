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
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('immobile_id');
            $table->boolean('tv');
            $table->boolean('wifi');
            $table->boolean('air_conditioning');
            $table->boolean('bathroom');
            $table->boolean('moving');
            $table->boolean('furnished');
            $table->boolean('garage');
            $table->boolean('ordinance');
            $table->boolean('reservation');
            $table->boolean('maintenance');
            $table->boolean('payment');
            $table->boolean('couple');
            $table->boolean('smoker');
            $table->boolean('pets');
            $table->boolean('visits');
            $table->timestamps();
            $table->foreign('immobile_id')->references('id')->on('immobiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amenities');
    }
};
