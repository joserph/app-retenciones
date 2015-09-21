@extends('master.layout')
@section ('title') Lista de Facturas I.V.A. | App-Retenciones @stop
@section('content')
    
    <legend><h2>Lista de Factuas I.V.A.</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Factuas I.V.A.</li>
    </ul>
    @if($totalFacturas > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <tr>
                <th>#</th>
                <th class="text-center">Factura</th>        
                <th class="text-center">Nota Crédito</th>
                <th class="text-center">Nota Débito</th>
                <th class="text-center">Retención</th> 
                <th class="text-center">Fecha</th> 
                <th class="text-center">Nº Control</th>
                <th class="text-center">Tipo Trans.</th>
                <th class="text-center">Monto</th>
                <th class="text-center">Acciones</th>
            </tr>
            @foreach ($facturas as $item)
            <tr>
                <td>{{ $contador += 1 }}</td>
                <td class="text-center">{{ $item->n_factura }}</td>
                <td class="text-center">{{ $item->n_nota_credito }}</td>
                <td class="text-center">{{ $item->n_nota_debito }}</td>        
                <td class="text-center">{{ $item->n_comp }}</td>            
                <td class="text-center">{{ date("d/m/Y", strtotime($item->fecha_fac)) }}</td>
                <td class="text-center">{{ $item->n_control }}</td>
                <td class="text-uppercase text-center">{{ $item->tipo_transa }}</td>
                <td class="text-center">{{ number_format($item->total_compra,2,",",".") }}</td>        
                <td class="text-center">
                    <a href="{{ route('facturas.show', $item->id) }}" class="btn btn-info btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
  
@stop