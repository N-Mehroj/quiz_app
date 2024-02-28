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
        Schema::create('result_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('result_id')->constrained('results_studets')->onDelete('cascade');
            $table->text('question');
            $table->text('option');
            $table->boolean('correct_type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_data');
    }
};
