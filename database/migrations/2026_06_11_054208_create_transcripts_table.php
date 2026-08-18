<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transcripts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transcript_request_id')->constrained('transcript_requests')->onDelete('cascade');
            $table->string('transcript_number')->unique();
            $table->string('verification_code')->unique();
            $table->decimal('cgpa', 3, 2);
            $table->string('classification'); // e.g. Upper Credit
            $table->string('file_path')->nullable(); // generated PDF path
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transcripts');
    }
};