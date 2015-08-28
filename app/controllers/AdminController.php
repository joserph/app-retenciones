<?php

class AdminController extends BaseController {


	public function getIndex()
	{
		return View::make('admin.index');
	}
	
	public function getUsers()
	{
		$users = User::all();
		return View::make('admin.users')->with('users', $users);
	}

}
