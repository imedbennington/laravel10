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
        Schema::create('like_idea', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('user_id')
              ->constrained('users')
              ->cascadeOnDelete()
              ->name('fk_like_idea_user_id');
              
            $table->foreignId('idea_id')
              ->constrained('ideas')
              ->cascadeOnDelete()
              ->name('fk_like_idea_idea_id');
              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_idea');
    }
};
