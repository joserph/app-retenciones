@extends('master.layout')

@section ('title') Lista de reportes excels | App-Retenciones @stop

@section('content')	
	<div class="table-responsive">
        <table class="table table-striped table-hover table-responsive">
            <tr>
                <th>#</th>                
                <th class="text-center">Fecha</th>
                <th class="text-center">Nº Comprobante</th>  
                <th class="text-center">Periodo</th>
            </tr>
            <?php $cont = 0;?>
            @foreach ($reportes as $item)
            <tr>
                <td>{{ $cont += 1 }}</td>                    
                <td class="text-center">{{ date("d/m/Y", strtotime($item->fecha)) }}</td>
                <td class="text-center">{{ $item->n_comp }}</td>
                <td class="text-center">{{ date("m-Y", strtotime($item->periodo)) }}</td>              
            </tr>
            @endforeach
        </table>
    </div>

    <a href="/excel-corte/{{ $dateFrom }}/{{ $dateTo }}">Generar XLS</a>
@stop