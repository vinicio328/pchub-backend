<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'costo'];

    public function components()
	{
		return $this->belongsToMany(Component::class, 'component_pc', 'pc_id');
	}
}
