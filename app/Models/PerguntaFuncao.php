<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PerguntaFuncao extends Pivot
{
    use HasFactory;

    protected $table = 'pergunta_funcao';

    protected $fillable = [
        'funcao_id',
        'pergunta_id',
        'required',
    ];

    public $timestamps = false;

    public function pergunta(){
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function funcao(){
        return $this->belongsTo(Funcao::class, 'funcao_id');
    }


}
