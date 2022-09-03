<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;
    protected $table = 'alunos';
    protected $fillable = [
        'id',
        'nome',
        'email',
        'documento',
        'endereco',
        'telefone',
        'sexo',
        'data_nascimento',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Relacionamento entre tabelas
     * Alunos e Histórico
     */
    public function historico()
    {
        return $this->hasMany(Historico::class, 'aluno', 'id');
    }
}
