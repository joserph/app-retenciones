@extends ('master.layout')
@section ('title') I.V.A. | App-Retenciones @stop
@section ('content')

   	@if(Auth::check())
	   <h1><a href="{{ route('iva.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar I.V.A."><i class="fa fa-plus fa-fw"></i> Agregar I.V.A.</a></h1>
    @endif
    <br>
    <legend><h3>Impuesto I.V.A.</h3></legend>
    @if($totalIva >= 1 && $iva != 'vencido')
        <div class="row text-center">
            <h2>{{ $iva->iva }} %</h2>
            <h4 class="text-capitalize">{{ $iva->estatus }}</h4>
            <h4>Vigencia: {{ date("d/m/Y", strtotime($iva->vigencia)) }}</h4> 
            @if (Auth::check() && Auth::user()->id_rol == 0)
                <a href="{{ route('iva.edit', $iva->id) }}" class="col-md-6 col-md-offset-3 btn btn-warning"><i class="fa fa-edit fa-fw"></i> Editar</a>
            @endif            
        </div>
    @elseif(Auth::check() && ($totalIva = 0 || !is_null($totalIva)) && $iva != 'vencido')
    	<div class="alert alert-dismissible alert-warning">
		  	<button type="button" class="close" data-dismiss="alert">×</button>
		  	<h4>Atención!</h4>
		  	<p>No has agregado el Impuesto I.V.A., para hacerlo has click en, <a href="{{ route('iva.create') }}" class="alert-link">Agregar I.V.A.<I class="V A "></I></a>.</p>
		</div>
    @endif
    
    <legend><h3>Historial</h3></legend>

    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>Impuesto</th>
                <th>Estatus</th>  
                <th>Vigencia</th>
            </tr>
            @foreach ($historialIva as $item)
                <tr>
                    <td>{{ $item->iva }}</td>
                    <td>{{ $item->estatus }}</td>
                    <td>{{ $item->vigencia }} </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop