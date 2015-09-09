@extends('master.layout')
@section ('title') Lista de Retenciones I.V.A. | App-Retenciones @stop
@section('content')
    
    @if(Auth::check())
	   <h1><a href="{{ route('reportes.create') }}" class="btn btn-success">Crear reporte</a></h1>
    @endif
    <legend><h2>Lista de Retenciones IVA</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Retenciones IVA</li>
    </ul>
    @if($totalReportes > 0)
    {{ Form::open(array('url' => '/reportes', 'method' => 'GET', 'role' => 'form', 'class' => 'form-horizontal')) }}
        <div class="input-group">
            {{ Form::text('buscar', null, array('class' => 'form-control input-sm', 'placeholder' => 'Buscar')) }}
            <span class="input-group-btn">
                <button type="submit" class="btn btn-success input-sm"><span class="glyphicon glyphicon-search" id="buscar" aria-hidden="true"></span></button>                
            </span>            
        </div>        
    {{ Form::close() }}
    <h3><span class="label label-info">Página {{ $reportes->getCurrentPage() }} de {{ $reportes->getLastPage() }}</span></h3>
    @endif
    <div class="table-responsive">
    <table class="table table-striped table-hover table-responsive">
    <tr>
        <th>#</th>
        <th class="text-center">Nº Comprobante</th>
        <th class="text-center">Fecha</th>  
        <th class="text-center">Periodo</th>
        <th class="text-center">Agente</th>
        <th class="text-center">Proveedor</th>
        @if(Auth::check() && (Auth::user()->id_rol == 0))
        <th class="text-center">Acciones</th>
        @endif
    </tr>
    <?php $cont = 0;?>
    @foreach ($reportes as $reporte)
    <tr>
        <td>{{ $cont += 1 }}</td>
        <td class="text-center">{{ $reporte->n_comp }}</td>
        <td class="text-center">{{ date("d/m/Y", strtotime($reporte->fecha)) }}</td>
        <td class="text-center">{{ date("m-Y", strtotime($reporte->periodo)) }}</td>
        @foreach($agentes as $agente)
            @if($agente->id == $reporte->id_agente)
                <td class="text-center">{{ $agente->nombre }}</td>
            @endif
        @endforeach
        @foreach($proveedores as $proveedor)
            @if($proveedor->id == $reporte->id_proveedor)
                <td class="text-center">{{ $proveedor->nombre }}</td>
            @endif
        @endforeach
        @if(Auth::check() && (Auth::user()->id_rol == 0))
            <td class="text-center">            
                <a href="{{ route('reportes.show', $reporte->id) }}" class="btn btn-primary btn-xs">Ver</a>   
                <a href="{{ route('reportes.edit', $reporte->id) }}" class="btn btn-warning btn-xs">Editar</a>            
            </td>
        @endif
    </tr>
    @endforeach
  </table>
  </div>
  
@stop