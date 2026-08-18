<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transcript_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('reference_number')->unique();
            $table->enum('purpose', ['employment', 'further_studies', 'other'])->default('other');
            $table->text('destination_address')->nullable();
            $table->enum('status', ['pending', 'payment_confirmed', 'processing', 'ready', 'completed', 'rejected'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transcript_requests');
    }
};