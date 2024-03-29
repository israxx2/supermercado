<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	
	use SoftDeletes;

	protected $table = 'roles';

	protected $fillable = [
		'Rol',
	];

	protected $dates = ['deleted_at'];
		
	public function users()
	{
		return $this->hasMany('App\User', 'id_rol');
	}
}
