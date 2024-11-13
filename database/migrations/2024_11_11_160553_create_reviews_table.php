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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assistant_id')->constrained('assistants')->onDelete('cascade'); // Relaciona com o produto
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relaciona com o usuário
            $table->tinyInteger('rating')->unsigned()->comment('Rating de 1 a 5');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
