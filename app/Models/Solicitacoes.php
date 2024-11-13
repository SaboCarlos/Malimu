<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacoes extends Model
{
    use HasFactory;

    // Definindo a tabela
    protected $table = 'solicitacoes';

    // Definindo os campos que podem ser atribuídos em massa
    protected $fillable = [
        'user_id',
        'assistant_id',
        'status_pagamento',
    ];

    // Relacionamento com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com o modelo Assistant
    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }
}
