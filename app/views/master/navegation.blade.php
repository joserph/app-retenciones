<nav>
	<ul>
		<li><a href=" {{ URL::route('home') }} ">Home</a></li>

		@if(Auth::check() && (Auth::user()->id_rol == 2))
			<li><a href=" {{ URL::route('account-sign-out') }} ">Sign out</a></li>
			<li><a href=" {{ URL::route('account-change-password') }} ">Change password</a></li>
		@elseif(Auth::check() && (Auth::user()->id_rol == 1))
			<li><a href=" {{ URL::route('account-sign-out') }} ">Sign out</a></li>
			<li><a href=" {{ URL::route('account-change-password') }} ">Change password</a></li>
			<li><a href=" {{ URL::route('editor') }} ">Editor</a></li>
		@elseif(Auth::check() && (Auth::user()->id_rol == 0))
			<li><a href=" {{ URL::route('account-sign-out') }} ">Sign out</a></li>
			<li><a href=" {{ URL::route('account-change-password') }} ">Change password</a></li>
			<li><a href=" {{ URL::route('editor') }} ">Editor</a></li>
			<li><a href=" {{ URL::route('admin') }} ">Administracion</a></li>
		@else
			<li><a href=" {{ URL::route('account-sign-in') }} ">Sign in</a></li>
			<li><a href=" {{ URL::route('account-create') }} ">Create an account</a></li>
			<li><a href=" {{ URL::route('account-forgot-password') }} ">Forgot password</a></li>
		@endif
	</ul>

</nav>