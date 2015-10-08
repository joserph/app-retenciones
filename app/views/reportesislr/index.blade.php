@extends('master.layout')
@section ('title') Lista de Retenciones I.S.L.R. | App-Retenciones @stop
@section('content')
    
    
    <legend><h2><i class="fa fa-file-pdf-o fa-fw"></i> Lista de Retenciones I.S.L.R.</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Retenciones I.S.L.R.</li>
    </ul>
    @if(Auth::check())
        <h1>
            <a href="{{ route('reportesislr.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Crear reporte I.S.L.R."><i class="fa fa-plus-circle fa-fw"></i> Crear reporte I.S.L.R.</a>
        </h1>
    @endif
    <br>
    <hr>
    @if($totalReportesislr > 10)
        {{ Form::open(array('url' => '/reportesislr', 'method' => 'GET', 'role' => 'form', 'class' => 'form-horizontal')) }}
            <div class="input-group">
                {{ Form::text('buscar', null, array('class' => 'form-control', 'placeholder' => 'Buscar reporte')) }}
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i></span></button> 
                </span>
            </div>
        {{ Form::close() }}
    <hr>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <tr>
                <th>#</th>
                <th class="text-center">Nº Comprobante</th>
                <th class="text-center">Fecha</th>  
                <th class="text-center">Periodo</th>
                <th class="text-center">Agente</th>
                <th class="text-center">Proveedor o Empleado</th>
                @if(Auth::check() && (Auth::user()->id_rol == 0))
                    <th class="text-center">Acciones</th>
                @endif
            </tr>            
            @foreach ($reportesislr as $item)
            <tr>
                <td>{{ $contador += 1 }}</td>
                <td class="text-center">{{ $item->n_comp }}</td>
                <td class="text-center">{{ date("d/m/Y", strtotime($item->fecha)) }}</td>
                <td class="text-center">{{ date("m-Y", strtotime($item->periodo)) }}</td>                
                <td class="text-center">{{ $agente->nombre }}</td>
                @foreach($empleados as $empleado)
                    @if($empleado->id == $item->id_empleado)                
                        <td class="text-center">{{ $empleado->nombre }}</td>
                    @endif
                @endforeach
                    
                
                <td class="text-center">            
                    <a href="{{ route('reportesislr.show', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>
                    @if(Auth::check())            
                        <a href="{{ route('reportesislr.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a> 
                    @endif           
                </td>
                
            </tr>
            @endforeach
        </table>
    </div>
  {{ $reportesislr->appends(array('buscar' => Input::get('buscar')))->links() }}
@stop