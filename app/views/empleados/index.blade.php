@extends('master.layout')
@section ('title') Lista de Empleados y Proveedores I.S.L.R. | App-Retenciones @stop
@section('content')
    
    <legend><h2><i class="fa fa-users fa-fw"></i> Lista de Empleados y Proveedores I.S.L.R.</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Empleados y Proveedores I.S.L.R.</li>
    </ul>
    @if(Auth::check())
        <h1>
            <a href="{{ route('empleados.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar empleado o proveedor"><i class="fa fa-plus fa-fw"></i> Agregar empleado o proveedor</a>
        </h1>
    @endif
    <br>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <tr>
                <th>#</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">RIF</th>  
                <th class="text-center">%</th>  
                <th class="text-center">Dirección</th>
                <th class="text-center">Acción</th>
            </tr>            
            @foreach ($empleados as $item)
            <tr>
                <td>{{ $contador += 1 }}</td>
                <td>{{ $item->nombre }}</td>
                <td class="text-center">{{ $item->rif }}</td>
                <td class="text-center">{{ $item->porcentaje }}</td>
                <td>{{ substr($item->direccion, 0, 50) }}...</td>
                <td class="text-center">
                    <a href="{{ route('empleados.show', $item->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>
                    @if(Auth::check())
                        <a href="{{ route('empleados.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
  {{ $empleados->links() }}
@stop