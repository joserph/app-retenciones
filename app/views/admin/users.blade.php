@extends('master.layout')

@section('content')
	
	<table class="table table-condensed">
	    <tr>
	        <th>Username</th>
	        <th>Email</th>  
	        <th>Rol</th>
	    </tr>
	    @foreach ($users as $user)
		    <tr>
		        <td>{{ $user->username }}</td>
		        <td>{{ $user->email }}</td>
		        <td>{{ $user->id_rol}} </td>
		    </tr>
    	@endforeach
  	</table>
	
@stop