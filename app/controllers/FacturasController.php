<?php

class FacturasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$facturas = Factura::all();
		$totalFacturas = DB::table('facturas')->count();
        $contador = 0;

		return View::make('facturas.index', array(
			'facturas' => $facturas,
			'totalFacturas' => $totalFacturas))
            ->with('contador', $contador);
		//var_dump($facturas);
	}

	public function getFacturas()
    {
        $facturas = new Factura;
        $iva = DB::table('impuesto')->where('estatus', '=', 'actual')->first();
        return View::make('facturas.form', array(
            'facturas' => $facturas, 
            'iva' => $iva
        ));
    }

    public function postFacturas()
    {
        date_default_timezone_set('America/Caracas');
        //comprobamos si es una petición ajax
        if(Request::ajax()){
            //validamos el formulario
            $registerData = array(
                'factura'           =>   Input::get('factura'),
                'n_comp'            =>   Input::get('n_comp'),
                'fecha_fac'         =>   Input::get('fecha_fac'),
                'n_factura'         =>   Input::get('n_factura'),
                'n_control'         =>   Input::get('n_control'),
                'n_nota_debito'     =>   Input::get('n_nota_debito'),
                'n_nota_credito'    =>   Input::get('n_nota_credito'),
                'tipo_transa'       =>   Input::get('tipo_transa'),
                'n_fact_ajustada'   =>   Input::get('n_fact_ajustada'),
                'total_compra'      =>   Input::get('total_compra'),
                'exento'            =>   Input::get('exento'),
                'base_imp'          =>   Input::get('base_imp'),
                'iva'               =>   Input::get('iva'),
                'impuesto_iva'      =>   Input::get('impuesto_iva'),
                'iva_retenido'      =>   Input::get('iva_retenido'),
                'id_proveedor'      =>   Input::get('id_proveedor'),
                'id_user'           =>   Input::get('id_user'),
                'update_user'       =>   Input::get('update_user'),
                'id_reporte'        =>   Input::get('id_reporte')
            );
                
            $rules = array(
                'factura'           =>   'unique:facturas',
                'fecha_fac'         =>   'required',
                'n_factura'         =>   '',
                'n_control'         =>   'required',
                'n_nota_debito'     =>   '',
                'n_nota_credito'    =>   '',
                'tipo_transa'       =>   'required',
                'n_fact_ajustada'   =>   '',
                'total_compra'      =>   'required',
                'exento'            =>   '',
                'base_imp'          =>   '',
                'iva'               =>   '',
                'impuesto_iva'      =>   '',
                'iva_retenido'      =>   '',
                'id_user'           =>   '',
                'update_user'       =>   '',
                'id_reporte'        =>   ''
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
                $content = new Factura($registerData);
                $content->save(); 
                //si se realiza correctamente la inserción envíamos un mensaje
                //conforme se ha registrado correctamente
                if($content)
                {
                    $facturas = DB::table('facturas')->get();
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
		$facturas = Factura::find($id);
        $user = DB::table('users')->where('id', '=', $facturas->id_user)->first();
        $reporte = DB::table('reportes')->where('id', '=', $facturas->id_reporte)->first();
        if (is_null($facturas))
        {
            App::abort(404);
        }

        return View::make('facturas.show', array(
            'facturas' => $facturas,
            'user' => $user,
            'reporte' => $reporte
            )
        );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$facturas = Factura::find($id);

        if (is_null($id))
        {
            App::abort(404);
        }

        return View::make('facturas.edit')
            ->with('facturas', $facturas);
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
		// Creamos un nuevo objeto 
        $facturas = Factura::find($id);
        
        // Si no existe entonces lanzamos un error 404 :(
        if (is_null($facturas))
        {
            App::abort(404);
        }
        
        // Obtenemos la data enviada por el usuario
        $data = Input::all();
        
        // Revisamos si la data es válido
        if ($facturas->isValid($data))
        {
            // Si la data es valida se la asignamos 
            $facturas->fill($data);
            // Guardamos
            $facturas->save();
            // Y Devolvemos una redirección a la acción show para mostrar el usuario
            return Redirect::route('reportes.show', array($facturas->id_reporte))
                    ->with('editar', 'La factura ha sido actualizada correctamente.');
        }
        else
        {
            // En caso de error regresa a la acción edit con los datos y los errores encontrados
            return Redirect::route('facturas.edit', $facturas->id)
                    ->withInput()
                    ->withErrors($facturas->errors);
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
		$facturas = Factura::find($id);
        
        if (is_null ($facturas))
        {
            App::abort(404);
        }
        
        $facturas->delete();

        return Redirect::route('reportes.show', array($facturas->id_reporte))
            ->with('delete', 'La factura ha sido eliminada correctamente.');
        
	}


}
