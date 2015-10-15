<?php

class ReportesventasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function getReportes()
	{
		$reportesVentas = new Reportesventa;        
        return View::make('reportesventas.form', array(
            'reportesVentas' => $reportesVentas
        ));
	}

	public function postReportes()
	{
		date_default_timezone_set('America/Caracas');
        //comprobamos si es una petición ajax
        if(Request::ajax()){
            //validamos el formulario
            $registerData = array(
                'total_v'		=>   Input::get('total_v'),
                'tributado'    	=>   Input::get('tributado'),
                'exento'        =>   Input::get('exento'),
                'impuesto'      =>   Input::get('impuesto'),
                'id_fecha'      =>   Input::get('id_fecha'),                
                'id_user'       =>   Input::get('id_user'),
                'update_user'	=>   Input::get('update_user')
            );
             
            $rules = array(
                'total_v'     	=>   'required',
                'tributado'     =>   'required',
                'exento'     	=>   'required',
                'impuesto'     	=>   'required',
                'id_fecha'     	=>   'required',                
                'id_user'       =>   'required',
                'update_user'   =>   'required',
            );
                 
            $messages = array(
                'required'      => 'El campo :attribute es obligatorio.',
                'min'           => 'El campo :attribute no puede tener menos de :min carácteres.',
                'email'         => 'El campo :attribute debe ser un email válido.',
                'max'           => 'El campo :attribute no puede tener más de :max carácteres.',
                'unique'        => 'La factura ingresada ya está agregada en la base de datos.',
                'confirmed'     => 'Los passwords no coinciden.'
            );
                
            $validation = Validator::make(Input::all(), $rules, $messages);
            //si la validación falla redirigimos al formulario de registro con los errores   
            if ($validation->fails())
            {
                //como ha fallado el formulario, devolvemos los datos en formato json
                //esta es la forma de hacerlo en laravel, o una de ellas
                return Response::json(array(
                    'success' => false,
                    'errors' => $validation->getMessageBag()->toArray()
                )); 
                //en otro caso ingresamos al usuario en la tabla usuarios
            }else{
                //creamos un nuevo usuario con los datos del formulario
                $content = new Reportesventa($registerData);
                $content->save(); 
                //si se realiza correctamente la inserción envíamos un mensaje
                //conforme se ha registrado correctamente
                if($content)
                {
                    $facturas = DB::table('reportesventas')->get();
                    return Response::json(array(
                        'success'       =>  true,
                        'message'       =>  "<h3>Comentario creado correctamente.</h3>",
                        'facturas'         =>  $facturas
                    ));
                }
            }
        }
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
		$reportesVentas = Reportesventa::find($id);
        $ventas = DB::table('ventas')->where('id', '=', $reportesVentas->id_fecha)->first();
        $agente = Agente::find(1);

        if (is_null($id))
        {
            App::abort(404);
        }

        return View::make('reportesventas.edit', array(
            'ventas' => $ventas,
            'agente' => $agente
        ))->with('reportesVentas', $reportesVentas);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        date_default_timezone_set('America/Caracas');
		// Creamos un nuevo objeto para nuestro nuevo usuario
        $reportesVentas = Reportesventa::find($id);
        
        // Si el usuario no existe entonces lanzamos un error 404 :(
        if (is_null($reportesVentas))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($reportesVentas->isValid($data))
        {
            // Si la data es valida se la asignamos al usuario
            $reportesVentas->fill($data);
            // Guardamos el usuario
            $reportesVentas->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('ventas.show', array($reportesVentas->id_fecha))
                    ->with('editar', 'El reporte de venta ha sido actualizada correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('reportesventas.edit', $reportesVentas->id)
                    ->withInput()
                    ->withErrors($reportesVentas->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$reportesVentas = Reportesventa::find($id);
        
        if (is_null ($reportesVentas))
        {
            App::abort(404);
        }
        
        $reportesVentas->delete();
        
        return Redirect::route('ventas.show', array($reportesVentas->id_fecha))
            ->with('delete', 'El reporte de venta ha sido eliminada correctamente.');
        
	}


}
