@extends('master.layout')

@section ('title') Lista de reportes excels | App-Retenciones @stop

@section('content')

	<h2>Lista de reportes excels</h2>
	<div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
        	<tr>
        		<th>FECHA</th>
        		<th>COMPROBANTE</th>
        	</tr>
        @foreach($reportes as $item)
        	@if(date('d', strtotime($item->fecha)) < 16)
	        	<tr class="active">
	        		<td>{{ $item->fecha }}</td>
	        		<td>{{ $item->n_comp }}</td>
	        	</tr>
	        @else 
				<tr class="info">
	        		<td>{{ $item->fecha }}</td>
	        		<td>{{ $item->n_comp }}</td>
	        	</tr>
	        @endif
        @endforeach
        </table>
    </div>
@stop