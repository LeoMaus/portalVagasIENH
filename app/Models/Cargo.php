<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    // Define o nome da tabela associada ao model
    protected $table = 'cargo';

    // Defina quais campos podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'descricao',
        'responsabilidades',
        'area_id',
    ];

    // Se você estiver usando timestamps automáticos, deixe isso como verdadeiro
    // Caso contrário, defina como falso
    public $timestamps = true;
}
