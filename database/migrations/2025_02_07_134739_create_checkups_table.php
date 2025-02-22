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
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients');
            $table->foreignId('doctor_id')->references('id')->on('users');
            $table->date('checkup_date');
            $table->float('height');
            $table->float('weight');
            $table->integer('systole');
            $table->integer('diastole');
            $table->integer('heart_rate');
            $table->integer('respiration_rate');
            $table->float('temperature');
            $table->text('diagnosis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkups');
    }
};
