<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable = ['token'];

    public function categoria(){
        return $this->morphedByMany('\App\Categoria', 'tokenable');
    }

    public function produto(){
        return $this->morphedByMany('\App\Produto', 'tokenable');
    }
}
