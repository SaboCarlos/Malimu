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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID do usuário que solicitou
            $table->foreignId('assistant_id')->constrained('assistants')->onDelete('cascade'); // ID do assistente solicitado
            $table->string('status_pagamento')->default('pendente'); // Status do pagamento ("pendente" ou "pago")
            $table->timestamp('data_solicitacao')->useCurrent(); // Data e hora da solicitação
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
