<?php

class AdminController extends BaseController {


	public function getIndex()
	{
		return View::make('admin.index');
	}
	
	public function getUsers()
	{
		$users = User::all();
		$contador = 0;
		return View::make('admin.users')
			->with('users', $users)
			->with('contador', $contador);
	}

}
