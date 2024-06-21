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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->float('adaptability_to_change', 3, 2)->unsigned();
            $table->float('safe_conduct', 3, 2)->unsigned();
            $table->float('dynamism_energy', 3, 2)->unsigned();
            $table->float('personal_effectiveness', 3, 2)->unsigned();
            $table->float('initiative', 3, 2)->unsigned();
            $table->float('working_under_pressure', 3, 2)->unsigned();
            $table->dateTime('date');
            $table->timestamps();

            $table->foreignId('worker_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
