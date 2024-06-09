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
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students', 'lrn')->cascadeOnDelete();
            $table->foreignId('school_personnel_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('quarter_id')->unsigned();
            $table->foreign('quarter_id')->references('id')->on('quarters')->cascadeOnDelete();
            $table->text('description');
            $table->text('task');
            $table->dateTime('cleared_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
