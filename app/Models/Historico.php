<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;
    protected $table = 'historico_locacao';
    protected $fillable = [
        'id',
        'aluno',
        'livro',
        'situacao_livro',
        'data_locacao',
        'data_devolucao'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relacionamento entre tabelas
     * Alunos e Histórico
     */
    public function aluno()
    {
        return $this->belongsTo(Alunos::class, 'aluno', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relacionamento entre tabelas
     * Livros e Histórico
     */
    public function livro()
    {
        return $this->belongsTo(Livros::class, 'livro', 'id');
    }
}
