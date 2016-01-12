@extends('master.layout')
@section ('title') Todas las ventas de {{ $agente->nombre }} | App-Retenciones @stop
@section('content')
    
    <legend><h2><i class="fa fa-file-text fa-fw"></i> Todas las ventas de {{ $agente->nombre }}</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ route('ventas.index') }}">Ventas de {{ $agente->nombre }}</a></li>
        <li class="active">Todas las ventas de {{ $agente->nombre }}</li>
    </ul>
    @if($totalVentas > 10)
        {{ Form::open(array('url' => '/all-ventas', 'method' => 'GET', 'role' => 'form', 'class' => 'form-horizontal')) }}
            <div class="input-group">
                {{ Form::text('buscar', null, array('class' => 'form-control', 'placeholder' => 'Buscar ventas', 'autofocus'=>'autofocus')) }}
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i></span></button> 
                </span>
            </div>
        {{ Form::close() }}
        <hr>
    @endif
    @if($totalVentas > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <tr>
                <th>#</th>
                <th class="text-center">Fecha</th>        
                <th class="text-center">Total venta</th>
                <th class="text-center">Monto tributos</th>
                <th class="text-center">Monto exento</th> 
                <th class="text-center">Monto impuesto</th> 
                <th class="text-center">Acciones</th>
            </tr>
            @foreach ($ventas as $item)
            <tr>
                <td>{{ $contador += 1 }}</td>
                <td class="text-center">
                    @foreach($fechaVentas as $fechaVenta)
                        @if($fechaVenta->id == $item->id_fecha)
                            {{ date("d/m/Y", strtotime($fechaVenta->fecha_z)) }}
                        @endif
                    @endforeach
                </td>          
                <td class="text-center">{{ number_format($item->total_v,2,",",".") }}</td>
                <td class="text-center">{{ number_format($item->tributado,2,",",".") }}</td> 
                <td class="text-center">{{ number_format($item->exento,2,",",".") }}</td> 
                <td class="text-center">{{ number_format($item->impuesto,2,",",".") }}</td>        
                <td class="text-center">
                    <a href="{{ route('ventas.show', $item->id_fecha) }}" class="btn btn-info btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
    {{ $ventas->appends(array('buscar' => Input::get('buscar')))->links() }}
@stop