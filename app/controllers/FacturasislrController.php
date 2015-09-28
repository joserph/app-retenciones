<?php

class FacturasislrController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
        $facturasislr = DB::table('facturasislr')->orderBy('created_at', 'desc')->paginate(10);
        $reportesislr = Reporteislr::all();
        $agente = Agente::find(1);
        $totalFactuasIslr = DB::table('facturasislr')->count();
        $contador = 0;

		return View::make('facturasislr.index',array(
            'facturasislr' => $facturasislr,
            'reportesislr' => $reportesislr,
            'agente' => $agente,
            'totalFactuasIslr' => $totalFactuasIslr
        ))->with('contador', $contador);

		
	}

	public function getFacturas()
    {
        $facturas = new Facturaislr;        
        return View::make('facturas.form', array(
            'facturas' => $facturas
        ));
    }

    public function postFacturas()
    {
        date_default_timezone_set('America/Caracas');
        //comprobamos si es una petición ajax
        if(Request::ajax()){
            //validamos el formulario
            $registerData = array(
                'fecha_fac'           =>   Input::get('fecha_fac'),
                'n_factura'            =>   Input::get('n_factura'),
                'n_codigo'         =>   Input::get('n_codigo'),
                'n_comp'         =>   Input::get('n_comp'),
                'n_control'         =>   Input::get('n_control'),
                'total_compra'     =>   Input::get('total_compra'),
                'objreten'    =>   Input::get('objreten'),
                'base_imp'       =>   Input::get('base_imp'),
                'iva'   =>   Input::get('iva'),
                'impuesto_iva'      =>   Input::get('impuesto_iva'),
                'tipo'            =>   Input::get('tipo'),
                'id_proveedor'      =>   Input::get('id_proveedor'),
                'id_user'           =>   Input::get('id_user'),
                'update_user'       =>   Input::get('update_user'),
                'id_reporteislr'        =>   Input::get('id_reporteislr')
            );
             
            $rules = array(
                'fecha_fac'     =>   'required',
                'n_factura'     =>   'unique:facturasislr',
                'n_codigo'     	=>   'required',
                'n_comp'     	=>   '',
                'n_control'     =>   '',
                'total_compra' 	=>   'required',
                'objreten'    	=>   'required',
                'base_imp'      =>   '',
                'iva'   		=>   'required',
                'impuesto_iva'	=>   'required',
                'tipo'          =>   'required',
                'id_proveedor'  =>   'required',
                'id_user'       =>   'required',
                'update_user'   =>   'required',
                'id_reporteislr'=>   'required',
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
                $content = new Facturaislr($registerData);
                $content->save(); 
                //si se realiza correctamente la inserción envíamos un mensaje
                //conforme se ha registrado correctamente
                if($content)
                {
                    $facturas = DB::table('facturasislr')->get();
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
