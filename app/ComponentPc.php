<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentPc extends Model
{
	protected $fillable = ['pc_id', 'component_id'];
	protected $table = 'elemento_menu';	

	public function pc() 
	{
		return $this->belongsTo(Pc::class, 'pc_id');
	}

	public function component() 
	{
		return $this->belongsTo(Component::class, 'component_id');
	}
}
