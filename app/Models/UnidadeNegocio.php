<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeNegocio extends Model
{
    use HasFactory;

    // Define o nome da tabela associada ao model
    protected $table = 'unidade_negocio';

    // Defina quais campos podem ser preenchidos em massa
    protected $fillable = [
        'descricao',
        'id_empresa',
        'id_un_pai',
        'id_responsavel',
        'ativo',
        'id_usuario_criacao',
        'log',
    ];

    // Se você estiver usando timestamps automáticos, deixe isso como verdadeiro
    // Caso contrário, defina como falso
    public $timestamps = true;
}
