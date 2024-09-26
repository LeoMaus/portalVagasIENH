<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // Define o nome da tabela associada ao model
    protected $table = 'area';

    // Defina quais campos podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'descricao',
    ];

    // Se você estiver usando timestamps automáticos, deixe isso como verdadeiro
    // Caso contrário, defina como falso
    public $timestamps = true;
}
