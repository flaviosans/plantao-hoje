<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    public function endereco(){
        return $this->morphToMany('\App\Endereco', 'enderecavel');
    }

    public function item(){
        return $this->morphToMany('\App\Item', 'petivel');
    }


}
