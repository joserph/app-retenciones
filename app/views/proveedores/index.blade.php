@extends('master.layout')
@section ('title') Lista de Proveedores @stop
@section('content')
    
    <legend><h2>Lista de Proveedores</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Proveedores</li>
    </ul>

    @if(Auth::check())
       <h1>
            <a href="{{ route('proveedores.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar proveedor"><i class="fa fa-plus fa-fw"></i> Agregar proveedor</a>
        </h1>
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
                    <th class="text-center">Acciones</th>
                </tr>
                <?php $cont = 0;?>
                @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $cont += 1 }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td class="text-center">{{ $proveedor->rif }}</td>
                    <td class="text-center">{{ $proveedor->porcentaje }}</td>
                    <td>{{ substr($proveedor->direccion, 0, 50) }}...</td>
                    <td class="text-center">
                        <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-info btn-xs">Ver </a>
                        @if(Auth::check() && (Auth::user()->id_rol == 0))
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-xs"> Editar</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        {{ $proveedores->links() }}
    @endif
@stop