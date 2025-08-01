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
        Schema::create('question_assigned', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extinguisher_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained('inspection_questions')->onDelete('cascade');
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_assigned');
    }
};
