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
			$name = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$size = File::size($file);
			//dd($size);
			$data = array(
				'nombre'	=> $name,
				'extension'	=> $extension,
				'size'		=> $size
			);
			$rules = array(
	            'extension' => 'required|mimes:jpeg',
        	);   
        	$messages = array(
                'required'      => 'El campo :attribute es obligatorio.',
                'min'           => 'El campo :attribute no puede tener menos de :min carácteres.',
                'email'         => 'El campo :attribute debe ser un email válido.',
                'max'           => 'El campo :attribute no puede tener más de :max carácteres.',
                'unique'        => 'La factura ingresada ya está agregada en la base de datos.',
                'confirmed'     => 'Los passwords no coinciden.',
                'mimes'         => 'El campo :attribute debe ser un archivo de tipo :values.',
            );
            $validation = Validator::make($rules, $messages);

            if($validation->fails())
            {
            	return Redirect::route('logo-post')
					->withInput()->withErrors($validation);
            }else{
				$path = public_path().'/assets/img/';
				$newName = 'logo';
			
				$subir = $file->move($path, $newName . '.' . $extension);

				return Redirect::route('agente.index')
					->with('create', 'El logo ha sido actualizado correctamente!');				
				
			}
			
		}else{
			return Redirect::route('logo-post')
				->with('global', 'Es necesario que selecciones una imagen.');
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
