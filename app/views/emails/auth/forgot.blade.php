<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body style="background: #BEF3FA; font-size: 14px; margin: 0px; padding: 0px; font-family: Helvetica; color: #000000;">
	<br>
	<div style="background-color: #ffffff; border-radius: 4px; padding: 25px; max-width: 500px; margin: 0 auto;">
		<h2 style="text-align: center; font-family: Helvetica;">Cambio de contraseña</h2>
		<p>Hola <i>{{ $username }}</i>,</p>
		<p>Su nueva contraseña es: <b>{{ $password }}</b></p>
		<p>Parece que ha solicitado una nueva contraseña. Tendrá que utilizar el siguiente enlace para activarlo:</p>
		<div style="background-color: #1859FF; border-radius: 6px; padding: 13px; max-width: 160px; height: 100%;">
			<a href="{{ $link }}" style="text-align: center; color: #fff; width: 100%; text-decoration: none;"><b>Cambiar de contraseña</b></a>
		</div>
		<p>Si usted no solicitó una nueva contraseña, por favor, ignora este mensaje.</p>	
		<p>Gracias.</p>
		<hr>
		<p>&mdash; App Retenciones</p>		
	</div>
	
	<p style="text-align: center; font-family: Helvetica;">Follow <a href="http://twitter.com/joserph_a">@joserph_a</a> on Twitter.</p>
	<hr>
	<br>
	
</body>
</html>