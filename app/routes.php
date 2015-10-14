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
	});

	/* Filtro para los Editores */
	Route::group(array('before' => 'editor'), function()
	{
		Route::get('/editor', array(
			'as' => 'editor',
			'uses' => 'EditorController@getIndex'
		));

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

		Route::resource('reportesislr', 'ReportesislrController');

		Route::resource('facturasislr', 'FacturasislrController');

		Route::get('facturas-islr-create', 'FacturasislrController@getFacturas');

		Route::post('facturas-islr-create', 'FacturasislrController@postFacturas');

		Route::get('/pdfislr/{id}', array(
			'as' => 'pdf-islr',
			'uses' => 'PdfController@getIndexIslr'
		));

		Route::resource('ventas', 'VentasController');

		Route::resource('reportesventas', 'ReportesventasController');

		Route::get('reportes-ventas-create', 'ReportesventasController@getReportes');

		Route::post('reportes-ventas-create', 'ReportesventasController@postReportes');
	});

});
/* Rutas sin filtros */
Route::resource('agente', 'AgenteController',
                array('only' => array('index', 'show')));

Route::resource('iva', 'IvaController',
                array('only' => array('index', 'show')));

Route::resource('proveedores', 'ProveedoresController',
                array('only' => array('index', 'show')));

Route::resource('reportes', 'ReportesController',
                array('only' => array('index', 'show')));

Route::resource('facturas', 'FacturasController',
                array('only' => array('index', 'show')));

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