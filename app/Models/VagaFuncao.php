<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VagaFuncao extends Model
{
    use HasFactory;
    protected $table = 'vaga_funcao';
    protected $fillable = [
        'vaga_id',
        'funcao_id',
    ];

    public $timestamps = false;

    public function vaga(){
        return $this->belongsTo(Vaga::class, 'vaga_id');
    }
    public function funcao(){
        return $this->belongsTo(Funcao::class, 'funcao_id');
    }
}
