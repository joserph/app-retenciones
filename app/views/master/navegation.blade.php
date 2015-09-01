<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
<!-- Navigation -->        
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('home') }}">App-Retenciones</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">                      	
            @if(Auth::check())
            	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                   Bienvenido <strong><em>{{ Auth::user()->username }}</em></strong> 
                </a>                	
            @else
				<li><a href=" {{ URL::route('account-sign-in') }} "><i class="fa fa-sign-in fa-fw"></i> Sign in</a></li>
            @endif          
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->	

		<div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">                    
                    <li>
                        <a href="{{ URL::route('home') }}"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user fa-fw"></i> Usuario<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(Auth::check() && (Auth::user()->id_rol == 2))
								<li><a href=" {{ URL::route('account-sign-out') }} "><i class="fa fa-sign-out fa-fw"></i> Sign out</a></li>
								<li><a href=" {{ URL::route('account-change-password') }} "><i class="fa fa-refresh fa-fw"></i> Change password</a></li>
							@elseif(Auth::check() && (Auth::user()->id_rol == 1))
								<li><a href=" {{ URL::route('account-sign-out') }} "><i class="fa fa-sign-out fa-fw"></i> Sign out</a></li>
								<li><a href=" {{ URL::route('account-change-password') }} "><i class="fa fa-refresh fa-fw"></i> Change password</a></li>
								<li><a href=" {{ URL::route('editor') }} ">Editor</a></li>
							@elseif(Auth::check() && (Auth::user()->id_rol == 0))
								<li><a href=" {{ URL::route('account-sign-out') }} "><i class="fa fa-sign-out fa-fw"></i> Sign out</a></li>
								<li><a href=" {{ URL::route('account-change-password') }} "><i class="fa fa-refresh fa-fw"></i> Change password</a></li>
								<li><a href=" {{ URL::route('editor') }} "><i class="fa fa-gear fa-fw"></i> Editor</a></li>
								<li><a href=" {{ URL::route('admin') }} "><i class="fa fa-gear fa-fw"></i> Administracion</a></li>
							@else
								<li><a href=" {{ URL::route('account-sign-in') }} "><i class="fa fa-sign-in fa-fw"></i> Sign in</a></li>
								<li><a href=" {{ URL::route('account-create') }} "><i class="fa fa-plus fa-fw"></i> Create an account</a></li>
								<li><a href=" {{ URL::route('account-forgot-password') }} "><i class="fa fa-key fa-fw"></i> Forgot password</a></li>
							@endif
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="panels-wells.html">Panels and Wells</a>
                            </li>
                            <li>
                                <a href="buttons.html">Buttons</a>
                            </li>
                            <li>
                                <a href="notifications.html">Notifications</a>
                            </li>
                            <li>
                                <a href="typography.html">Typography</a>
                            </li>
                            <li>
                                <a href="icons.html"> Icons</a>
                            </li>
                            <li>
                                <a href="grid.html">Grid</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                   
                    <li>
                        <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="blank.html">Blank Page</a>
                            </li>
                            <li>
                                <a href="login.html">Login Page</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
            <!-- /.navbar-static-side -->	
</nav>