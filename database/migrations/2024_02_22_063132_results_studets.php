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
        Schema::create('results_studets', function (Blueprint $table) {
            $table->id();
            $table->text('userId');
            $table->foreignId('testDb_id')->constrained('testDb')->onDelete('cascade');
            $table->text('result_percentage');
            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('results_studets');
    }
};
