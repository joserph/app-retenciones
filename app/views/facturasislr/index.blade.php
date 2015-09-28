@extends('master.layout')
@section ('title') Lista de sueldos y factuas I.S.L.R. | App-Retenciones @stop
@section('content')
    
    <legend><h2>Lista de sueldos y factuas I.S.L.R.</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de sueldos y factuas I.S.L.R.</li>
    </ul>
    
    <div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <tr>
                <th>#</th>
                <th class="text-center">Retención</th> 
                <th class="text-center">Fecha</th> 
                <th class="text-center">Factura</th>
                <th class="text-center">Nº Código</th>
                <th class="text-center">Nº Control</th>        
                <th class="text-center">Total</th>
                <th class="text-center">Objreten</th>
                <th class="text-center">Base Imponible</th>
                <th class="text-center">% Retenido</th>
                <th class="text-center">Impuesto Retenido</th>
                <th class="text-center">Acciones</th>
            </tr>
            @foreach ($facturasislr as $factura)
            <tr>
                <td>{{ $contador += 1 }}</td>        
                <td class="text-center">{{ $factura->n_comp }}</td>            
                <td class="text-center">{{ date("d/m/Y", strtotime($factura->fecha_fac)) }}</td>
                <td class="text-center">{{ $factura->n_factura }}</td>
                <td class="text-center">{{ $factura->n_codigo }}</td>
                <td class="text-center">{{ $factura->n_control }}</td>
                <td class="text-center">{{ number_format($factura->total_compra,2,",",".") }}</td>
                <td class="text-center">{{ number_format($factura->objreten,2,",",".") }}</td>
                <td class="text-center">{{ number_format($factura->base_imp,2,",",".") }}</td>
                <td class="text-center">{{ number_format($factura->iva,2,",",".") }}</td>
                <td class="text-center">{{ number_format($factura->impuesto_iva,2,",",".") }}</td>
                <td class="text-center">
                    <a href="{{ route('facturasislr.show', $factura->id) }}" class="btn btn-info btn-xs">Ver </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
  {{ $facturasislr->appends(array('buscar' => Input::get('buscar')))->links() }}
@stop