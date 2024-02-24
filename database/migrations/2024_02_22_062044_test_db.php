<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('testDb', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('desc');
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('time');
            $table->integer('quiz_count')->default(1);
            $table->integer('quiz_views_count')->default(1);
            $table->string('allowed_room_id')->nullable()->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }




    public function down(): void
    {
        Schema::dropIfExists('testDb');
    }
};
