<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PerguntaCargo extends Pivot
{
    use HasFactory;

    protected $table = 'pergunta_cargo';

    protected $fillable = [
        'cargo_id',
        'pergunta_id',
        'required',
    ];

    public $timestamps = false;

    public function pergunta(){
        return $this->belongsTo(Pergunta::class, 'pergunta_id');
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }


}
