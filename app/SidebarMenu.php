<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SidebarMenu extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	use SoftDeletes;

	protected $table = 'sidebar_menu';

	protected $fillable = [
		'nombre', 'url', 'id_rol','icono', 'por', 'id_padre', 'orden'
	];

	protected $dates = ['deleted_at'];
	
	public function creador()
	{
		return $this->belongsTo('App\User', 'por');
	}

	public function dropdowns()
	{
		return $this->hasMany('App\SidebarMenu', 'id_padre')->orderBy('orden', 'ASC');
	}

	
}
