<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'obs'
    ];

    public function endereco(){
        return $this->morphToMany('\App\Endereco', 'enderecavel');
    }

    public function item(){
        return $this->morphMany('\App\Item', 'lista');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }

}
