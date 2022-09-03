<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacoes extends Model
{
    use HasFactory;
    protected $table = 'locacoes';
    protected $fillable = [
        'id',
        'livro',
        'aluno',
        'data_locacao',
        'data_devolucao',
        'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relacionamento entre tabelas
     * Alunos e locações
     */
    public function aluno()
    {
        return $this->belongsTo(Alunos::class, 'aluno', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relacionamento entre tabelas
     * Livros e locações
     */
    public function livro()
    {
        return $this->belongsTo(Livros::class, 'livro', 'id');
    }
}
