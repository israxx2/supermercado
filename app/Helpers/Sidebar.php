<?php 
namespace App\Helpers;
use App\SidebarMenu;

class Sidebar {

	public static function get()
	{
		return SidebarMenu::orderBy('id', 'ASC')
		->where([
			['id_rol', auth()->user()->id_rol],
			['id_padre', 0]
		])->get();
	}
}




?>
