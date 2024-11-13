<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['assistant_id', 'user_id', 'rating', 'comment'];

    // Relacionamento com o Produto
    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }

    // Relacionamento com o Usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
