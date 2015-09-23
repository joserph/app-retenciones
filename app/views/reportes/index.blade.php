@extends('master.layout')
@section ('title') Lista de Retenciones I.V.A. | App-Retenciones @stop
@section('content')

    <legend><h2><i class="fa fa-file-pdf-o fa-fw"></i> Retenciones I.V.A.</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Retenciones I.V.A.</li>
    </ul>
    <div>
        @if(Auth::check())
           <h1>
                <a href="{{ route('reportes.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar reporte"><i class="fa fa-plus fa-fw"></i> Agregar reporte</a>
            </h1>
        @endif
    </div>
    <br>
    <hr>
    @if($totalReportes > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover table-responsive">
                <tr>
                    <th>#</th>
                    <th class="text-center">Nº Comprobante</th>
                    <th class="text-center">Fecha</th>  
                    <th class="text-center">Periodo</th>
                    <th class="text-center">Agente</th>
                    <th class="text-center">Proveedor</th>
                    @if(Auth::check())
                        <th class="text-center">Acción</th>
                    @endif
                </tr>
                <?php $cont = 0;?>
                @foreach ($reportes as $reporte)
                <tr>
                    <td>{{ $cont += 1 }}</td>
                    <td class="text-center">{{ $reporte->n_comp }}</td>
                    <td class="text-center">{{ date("d/m/Y", strtotime($reporte->fecha)) }}</td>
                    <td class="text-center">{{ date("m-Y", strtotime($reporte->periodo)) }}</td>                   
                    <td class="text-center">{{ $agente->nombre }}</td>                        
                    @foreach($proveedores as $proveedor)
                        @if($proveedor->id == $reporte->id_proveedor)
                            <td class="text-center">{{ $proveedor->nombre }}</td>
                        @endif
                    @endforeach
                    @if(Auth::check())                      
                        <td class="text-center">            
                            <a href="{{ route('reportes.show', $reporte->id) }}" class="btn btn-success btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>                        
                            <a href="{{ route('reportes.edit', $reporte->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>                             
                        </td>
                    @endif     
                   
                </tr>
                @endforeach
            </table>
        </div>
    @endif
  
@stop