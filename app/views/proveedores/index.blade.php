@extends('master.layout')
@section ('title') Lista de Proveedores I.V.A. | App-Retenciones @stop
@section('content')
    
    <legend><h2><i class="fa fa-building-o fa-fw"></i> Lista de Proveedores I.V.A.</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Proveedores I.V.A.</li>
    </ul>  
    @if(Auth::check())
       <h1>
            <a href="{{ route('proveedores.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar proveedor"><i class="fa fa-plus-circle fa-fw"></i> Agregar proveedor</a>
        </h1>
    @endif
    <br>
    <hr>
    @if($totalProveedores > 10)
        {{ Form::open(array('url' => '/proveedores', 'method' => 'GET', 'role' => 'form', 'class' => 'form-horizontal')) }}
            <div class="input-group">
                {{ Form::text('buscar', null, array('class' => 'form-control', 'placeholder' => 'Buscar proveedor')) }}
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i></span></button> 
                </span>
            </div>
        {{ Form::close() }}
    <hr>
    @endif
    @if($totalProveedores > 0)
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
                @foreach ($proveedores as $item)
                <tr>
                    <td>{{ $contador += 1 }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td class="text-center">{{ $item->rif }}</td>
                    <td class="text-center">{{ $item->porcentaje }}</td>
                    <td>{{ substr($item->direccion, 0, 50) }}...</td>
                    <td class="text-center">
                        <a href="{{ route('proveedores.show', $item->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>
                        @if(Auth::check())
                            <a href="{{ route('proveedores.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>     
    {{ $proveedores->appends(array('buscar' => Input::get('buscar')))->links() }}
    @endif
@stop