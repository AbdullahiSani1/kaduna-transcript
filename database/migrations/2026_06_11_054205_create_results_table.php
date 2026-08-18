<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses');
            $table->integer('score');
            $table->string('grade');
            $table->decimal('grade_point', 3, 2);
            $table->string('academic_session'); // e.g. 2023/2024
            $table->integer('level');
            $table->enum('semester', ['first', 'second']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};