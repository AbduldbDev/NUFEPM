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
        Schema::create('inspection_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_id')->constrained('inspection_logs')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('inspection_questions')->onDelete('cascade');
            $table->text('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_answers');
    }
};
