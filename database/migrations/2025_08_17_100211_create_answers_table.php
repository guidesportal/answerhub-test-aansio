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
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('survey_id'); // Reference to the survey
            $table->unsignedBigInteger('question_id'); // Reference to the question
            $table->unsignedBigInteger('user_id')->nullable(); // Optional: user who answered
            $table->text('answer'); // The actual answer
            $table->timestamps(); // created_at + updated_at

            // Foreign keys
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
