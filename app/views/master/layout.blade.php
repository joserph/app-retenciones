<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'App-Retenciones')</title>
	{{ HTML::style('assets/img/favicon.jpg', array('rel' => 'shortcut icon', 'type' => 'image/ico')) }}
	{{ HTML::style('assets/css/styles.css', array('media' => 'screen')) }}
	{{ HTML::style('assets/css/lumen-bootstrap.css', array('media' => 'screen')) }}
	{{ HTML::style('assets/css/metisMenu.min.css', array('media' => 'screen')) }}
	{{ HTML::style('assets/css/sb-admin-2.css', array('media' => 'screen')) }} 
	{{ HTML::style('assets/css/font-awesome.min.css', array('media' => 'screen')) }}
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div id="wrapper">
		@include('master.navegation')
	  	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">        	
		         	@if(Session::has('global'))
				  		<div class="alert alert-warning">
					      	<button type="button" class="close" data-dismiss="alert">×</button>
							<p>{{ Session::get('global') }}</p>
					    </div>
				    @endif
				    @if(Session::has('create'))
					    <div class="alert alert-dismissable alert-info">
						  	<button type="button" class="close" data-dismiss="alert">×</button>
						  	<p><strong><i class="fa fa-plus-circle fa-fw"></i> Bien hecho! </strong> {{ Session::get('create') }}</p>
						</div>	
				    @endif
				    @if(Session::has('editar'))
				    	<div class="alert alert-dismissable alert-success">
						  	<button type="button" class="close" data-dismiss="alert">×</button>
						  	<p><strong><i class="fa fa-refresh fa-fw"></i> Bien hecho! </strong> {{ Session::get('editar') }}</p>
						</div>			  		
				    @endif
				    @if(Session::has('delete'))
				    	<div class="alert alert-dismissable alert-danger">
						  	<button type="button" class="close" data-dismiss="alert">×</button>
						  	<p><i class="fa fa-trash fa-fw"></i> {{ Session::get('delete') }}</p>
						</div>
				    @endif
				    @yield('content')
				    <br>
					<hr>
				    
	       	</div><!--/row-->
  		</div><!--/col-span-9-->
	</div>
	@include('master.footer')
	<!--Javascript-->
	{{ HTML::script('assets/js/jquery.min.js') }}
	{{ HTML::script('assets/js/bootstrap.min.js') }}
	{{ HTML::script('assets/js/metisMenu.min.js') }}
	{{ HTML::script('assets/js/sb-admin-2.js') }}
	{{ HTML::script('assets/js/myScript.js') }}
	@yield('script')
	<script>
		$(function () {
  			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
	<!--Fin Javascript-->
</body>
</html>