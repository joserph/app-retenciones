@extends ('master.layout')
@section ('title') Impuesto I.V.A. | App-Retenciones @stop
@section ('content')

    <legend><h3><i class="fa fa-line-chart fa-fw"></i> Impuesto I.V.A.</h3></legend>

    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Impuesto I.V.A.</li>
    </ul>

    @if($totalIva >= 1 && $iva != 'vencido')
        <div class="row col-md-6 col-md-offset-3">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td class="active"><strong>I.V.A.</strong> <i class="fa fa-arrow-right fa-fw"></i></td> 
                        <td class="text-center success">{{ $iva->iva }}%</td>                    
                    </tr>
                     <tr>
                        <td class="active"><strong>Estatus</strong> <i class="fa fa-arrow-right fa-fw"></i></td> 
                        <td class="text-center text-capitalize success">{{ $iva->estatus }}</td>                   
                    </tr>
                    <tr>
                        <td class="active"><strong>Vigencia</strong> <i class="fa fa-arrow-right fa-fw"></i></td> 
                        <td class="text-center success">{{ date("d/m/Y", strtotime($iva->vigencia)) }}</td>                   
                    </tr>
                </table>
            </div>
            @if (Auth::check())
                <a href="{{ route('iva.edit', $iva->id) }}" class="col-md-12 btn btn-warning"><i class="fa fa-edit fa-fw"></i> Editar</a>
            @endif            
        </div>
    @elseif(Auth::check() && ($totalIva = 0 || !is_null($totalIva)) && $iva != 'vencido')
    	<div class="alert alert-dismissible alert-warning">
		  	<button type="button" class="close" data-dismiss="alert">×</button>
		  	<h4>Atención!</h4>
		  	<p>No has agregado el Impuesto I.V.A., para hacerlo has click en, <a href="{{ route('iva.create') }}" class="alert-link"><i class="fa fa-plus-circle fa-fw"></i> Agregar I.V.A.</a></p>
		</div>
    @elseif(Auth::check())
         <h1><a href="{{ route('iva.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar I.V.A."><i class="fa fa-plus-circle fa-fw"></i> Agregar I.V.A.</a></h1>
         <br>
    @endif
    
    <legend><h3>Historico</h3></legend>

    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Impuesto</th>
                <th class="text-center">Estatus</th>  
                <th class="text-center">Vigencia</th>
                @if (Auth::check())
                    <th class="text-center">Acción</th>
                @endif
            </tr>
            @foreach ($historialIva as $item)
                <tr>
                    <td class="text-center">{{ $contador += 1 }}</td>
                    <td class="text-center">{{ $item->iva }}%</td>
                    <td class="text-center text-capitalize">{{ $item->estatus }}</td>
                    <td class="text-center">{{ date("d/m/Y", strtotime($item->vigencia)) }} </td>
                    @if (Auth::check())
                        <td class="text-center">                            
                            <a href="{{ route('iva.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>   
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@stop