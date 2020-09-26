<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'costo'];

    public function pcs()
    {
        return $this->belongsToMany(Pc::class, 'component_pc');
    }    
}
