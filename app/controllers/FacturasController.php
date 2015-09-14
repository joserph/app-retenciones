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

		return View::make('facturas.index', array(
			'facturas' => $facturas,
			'totalFacturas' => $totalFacturas
		));
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
