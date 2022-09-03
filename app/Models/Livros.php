<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livros extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'categoria',
        'isbn',
        'titulo',
        'autor',
        'editora',
        'ano',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relacionamento entre tabelas
     * Livros e Categorias
     */
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categorias', 'categoria');
    }
}
