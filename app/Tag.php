<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['nome'];

    public function produto(){
        return $this->belongsToMany('\App\Produto');
    }


}

