<nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
<!-- Navigation -->        
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/img/logo.jpg') }}" alt="perfil" class="img-rounded logo-app" width="40">
        </a>
        <a class="navbar-brand titulo-app ussr" href="{{ URL::route('home') }}">App-Retenciones</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">                      	
            @if(Auth::check())
            	<li>
                    <a href="{{ route('profile.show', Auth::user()->username) }}">
                        Bienvenido <strong><em class="text-capitalize">{{ Auth::user()->username }}</em></strong> 
                    </a>
                </li>
                <li><a href=" {{ URL::route('account-sign-out') }} "><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a></li>             	
            @else
				<li><a href=" {{ URL::route('account-sign-in') }} "><i class="fa fa-sign-in fa-fw"></i> Iniciar sesión</a></li>
            @endif          
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->	

		<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">                    
                    <li>
                        <a href="{{ URL::route('home') }}"><i class="fa fa-home fa-fw"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Usuario<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(Auth::check() && (Auth::user()->id_rol == 2))
                                <li><a href="{{ route('profile.show', Auth::user()->username) }}"><i class="fa fa-dashboard fa-fw"></i> Perfil</a></li>
								<li><a href="{{ URL::route('account-sign-out') }}"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a></li>
								<li><a href="{{ URL::route('account-change-password') }}"><i class="fa fa-refresh fa-fw"></i> Cambiar contraseña</a></li>
							@elseif(Auth::check() && (Auth::user()->id_rol == 1))
                                <li><a href="{{ route('profile.show', Auth::user()->username) }}"><i class="fa fa-dashboard fa-fw"></i> Perfil</a></li>
								<li><a href="{{ URL::route('account-sign-out') }}"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a></li>
								<li><a href="{{ URL::route('account-change-password') }}"><i class="fa fa-refresh fa-fw"></i> Cambiar contraseña</a></li>
							@elseif(Auth::check() && (Auth::user()->id_rol == 0))
                                <li><a href="{{ route('profile.show', Auth::user()->username) }}"><i class="fa fa-dashboard fa-fw"></i> Perfil</a></li>
								<li><a href="{{ URL::route('account-sign-out') }}"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a></li>
								<li><a href="{{ URL::route('account-change-password') }}"><i class="fa fa-refresh fa-fw"></i> Cambiar contraseña</a></li>
								<li><a href="{{ URL::route('admin') }}"><i class="fa fa-gear fa-fw"></i> Administración</a></li>
							@else
								<li><a href="{{ URL::route('account-sign-in') }}"><i class="fa fa-sign-in fa-fw"></i> Iniciar sesión</a></li>
								<li><a href="{{ URL::route('account-create') }}"><i class="fa fa-plus-circle fa-fw"></i> Regístrate</a></li>
								<li><a href="{{ URL::route('account-forgot-password') }}"><i class="fa fa-key fa-fw"></i> Recuperar contraseña</a></li>
							@endif
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="{{ route('agente.index') }}"><i class="fa fa-building fa-fw"></i> Agente</a>
                    </li>
                    <li>
                        <a href="{{ route('iva.index') }}"><i class="fa fa-line-chart fa-fw"></i> I.V.A.</a>
                    </li>
                    <li>
                        <a class="text-"><i class="fa fa-long-arrow-right fa-fw"></i> [Impuesto al Valor Agregado] </a>
                    </li>
                    <li>
                        <a href="{{ route('proveedores.index') }}"><i class="fa fa-building-o fa-fw"></i> Proveedores</a>
                    </li>
                    <li>
                        <a href="{{ route('reportes.index') }}"><i class="fa fa-file-pdf-o fa-fw"></i> Reportes I.V.A.</a>
                    </li>
                    <li>
                        <a href="{{ route('facturas.index') }}"><i class="fa fa-file-text fa-fw"></i> Facturas I.V.A.</a>
                    </li>
                    <li>
                        <a class="text-"><i class="fa fa-long-arrow-right fa-fw"></i> [Impuesto Sobre la Renta] </a>
                    </li>
                    <li>
                        <a href="{{ route('empleados.index') }}"><i class="fa fa-building-o fa-fw"></i> Proveedores y Empleados</a>
                    </li>
                    <li>
                        <a href="{{ route('islr-reportes.index') }}"><i class="fa fa-file-pdf-o fa-fw"></i> Reportes I.S.L.R.</a>
                    </li>
                    <li>
                        <a href="{{ route('islr-facturas.index') }}"><i class="fa fa-file-text fa-fw"></i> Facturas I.S.L.R.</a>
                    </li>
                    <li>
                        <a class="text-"><i class="fa fa-long-arrow-right fa-fw"></i> [Compras y Ventas] </a>
                    </li>
                    <li>
                        <a href="{{ route('ventas.index') }}"><i class="fa fa-usd fa-fw"></i> Ventas</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
            <!-- /.navbar-static-side -->	
</nav>