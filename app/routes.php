<?php

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));


Route::get('/user/{username}', array(
	'as' => 'profile-user',
	'uses' => 'ProfileController@user'
));

Route::group(array('before' => 'auth'), function()
{
	/* CSRF proteccion group */

	Route::group(array('before' => 'csrf'), function()
	{
		/* Change password (POST) */

		Route::post('/account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));
	});

	/* Change password (GET) */

	Route::get('/account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));

	/* Sign out (GET) */

	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));

	/* Filtro para los Administradores */
	Route::group(array('before' => 'admon'), function()
	{
		/* Admin Account */
		Route::get('/admin', array(
			'as' => 'admin',
			'uses' => 'AdminController@getIndex'
		));
		
		Route::get('/admin/users', array(
			'as' => 'admin-users',
			'uses' => 'AdminController@getUsers'
		));

		//Route::resource('suscripcion', 'SuscripcionController');
		Route::get('/suscripcion', array(
			'as' => 'suscripcion',
			'uses' => 'SuscripcionController@getIndex'
		));

		Route::get('/suscripcion/create', array(
			'as' => 'suscripcion-create',
			'uses' => 'SuscripcionController@getCreate'
		));

		Route::post('/suscripcion/create', array(
			'as' => 'suscripcion-create-post',
			'uses' => 'SuscripcionController@postCreate'
		));

		Route::get('/suscripcion/activate/{code}', array(
			'as' => 'suscripcion-activate',
			'uses' => 'SuscripcionController@getActivate'
		));

	});

	/* Filtro para los Editores */
	Route::group(array('before' => 'editor'), function()
	{
		/*Route::get('/editor', array(
			'as' => 'editor',
			'uses' => 'EditorController@getIndex'
		));*/
		Route::group(array('before' => 'suscription'), function()
		{
			Route::resource('agente', 'AgenteController');

			Route::resource('iva', 'IvaController');

			Route::resource('proveedores', 'ProveedoresController');

			Route::resource('reportes', 'ReportesController');

			Route::resource('facturas', 'FacturasController');

			Route::get('facturas-iva-create', 'FacturasController@getFacturas');

			Route::post('facturas-iva-create', 'FacturasController@postFacturas');

			Route::get('/pdfiva/{id}', array(
				'as' => 'pdfiva',
				'uses' => 'PdfController@getIndexIva'
			));

			Route::resource('empleados', 'EmpleadosController');

			Route::resource('islr-reportes', 'ReportesislrController');

			Route::resource('islr-facturas', 'FacturasislrController');

			Route::get('facturas-islr-create', 'FacturasislrController@getFacturas');

			Route::post('facturas-islr-create', 'FacturasislrController@postFacturas');

			Route::get('/pdfislr/{id}', array(
				'as' => 'pdf-islr',
				'uses' => 'PdfController@getIndexIslr'
			));

			Route::resource('ventas', 'VentasController');

			Route::resource('all-ventas', 'AllVentasController');

			Route::resource('reportesventas', 'ReportesventasController');

			Route::get('reportes-ventas-create', 'ReportesventasController@getReportes');

			Route::post('reportes-ventas-create', 'ReportesventasController@postReportes');

			Route::get('excel', array(
				'as' => 'excel',
				'uses' => 'ExcelController@getIndex'
			));

			Route::post('excel', array(
				'as' => 'excel',
				'uses' => 'ExcelController@postIndex'
			));

			Route::get('/excel-corte/{desde}/{hasta}', array(
				'as'  => 'excel-corte',
				'uses' => 'ExcelController@getGenerate'
			));

			Route::get('/txt-corte/{desde}/{hasta}', array(
				'as'  => 'txt-corte',
				'uses' => 'ExcelController@getGenerateTxt'
			));

			Route::get('logo', array(
				'as' => 'logo',
				'uses' => 'LogoController@getUpload'
			));

			Route::post('logo', array(
				'as' => 'logo-post',
				'uses' => 'LogoController@postUpload'
			));
		});
		
	});
	
	Route::resource('profile', 'ProfileController');

});
/* Rutas sin filtros */
Route::resource('agente', 'AgenteController',
                array('only' => array('index')));

Route::resource('iva', 'IvaController',
                array('only' => array('index')));

Route::resource('proveedores', 'ProveedoresController',
                array('only' => array('index', 'show')));

Route::resource('reportes', 'ReportesController',
                array('only' => array('index')));

Route::resource('facturas', 'FacturasController',
                array('only' => array('index', 'show')));

Route::resource('empleados', 'EmpleadosController',
                array('only' => array('index', 'show')));

Route::resource('islr-reportes', 'ReportesislrController',
                array('only' => array('index')));

Route::resource('islr-facturas', 'FacturasislrController',
                array('only' => array('index', 'show')));

Route::resource('ventas', 'VentasController',
                array('only' => array('index')));

/* Fin Rutas sin filtros */

/* Autenticacion */
Route::group(array('before' => 'guest'), function()
{
	/* CSRF proteccion */
	Route::group(array('before' => 'csrf'), function()
	{
		/* Crear Cuenta (POST) */

		Route::post('/account/create', array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		));

		/* Sign in (POST)*/

		Route::post('/account/sign-in', array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));

		/* Forgot password (POST) */

		Route::post('/account/forgot-password', array(
			'as' => 'account-forgot-password-post',
			'uses' => 'AccountController@postForgotPassword'
		));

	});

	/* Forgot password (GET) */

	Route::get('/account/forgot-password', array(
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	));

	/* Recuperar code (GET) */

	Route::get('/account/recover/{code}', array(
		'as' => 'account-recover',
		'uses' => 'AccountController@getRecover'
	));

	/* Sign in (GET)*/

	Route::get('/account/sign-in', array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));

	/* Crear cuenta (GET) */

	Route::get('/account/create', array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));

	Route::get('/account/activate/{code}', array(
		'as' => 'account-activate',
		'uses' => 'AccountController@getActivate'
	));
});