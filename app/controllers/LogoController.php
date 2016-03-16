<?php

class LogoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function getUpload()
	{
		return View::make('logo.upload');
	}

	public function postUpload()
	{
		if(Input::hasFile('file'))
		{
			$file = Input::file('file');
			$url_file = $file->getClientOriginalName();
			$path = public_path().'/assets/img/';
			//dd($url_file);
			$subir = $file->move($path, $url_file . '.' . $file->getClientOriginalExtension());

			return Redirect::route('agente.index')
				->with('create', 'El logo ha sido actualizado correctamente!');
		}else{
			return Redirect::route('logo-post')
				->with('global', 'Es necesario que selecciones una imagen');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
