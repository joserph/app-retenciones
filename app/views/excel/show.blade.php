@extends('master.layout')

@section ('title') Lista de retenciones entre {{ date('d/m/Y', strtotime($dateFrom)) }} y {{ date('d/m/Y', strtotime($dateTo)) }} | App-Retenciones @stop

@section('content')	

    <legend><h3><i class="fa fa-file-excel-o fa-fw"></i> Lista de retenciones entre {{ date('d/m/Y', strtotime($dateFrom)) }} y {{ date('d/m/Y', strtotime($dateTo)) }}</h3></legend>
    
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li><a href="{{ route('reportes.index') }}">Lista de Retenciones I.V.A.</a></li>
        <li><a href="{{ URL::route('excel') }}">Generar corte de quincena</a></li>
        <li class="active">Lista de retenciones entre {{ date('d/m/Y', strtotime($dateFrom)) }} y {{ date('d/m/Y', strtotime($dateTo)) }}</li>
    </ul>
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

    <a href="/excel-corte/{{ $dateFrom }}/{{ $dateTo }}" class="btn btn-info col-xs-4 col-sm-4"><i class="fa fa-file-excel-o fa-fw"></i> Generar XLS</a>
    <a href="/txt-corte/{{ $dateFrom }}/{{ $dateTo }}.txt" class="btn btn-default col-xs-4 col-sm-4"><i class="fa fa-file-text-o fa-fw"></i> Generar TXT</a>
    <a href="{{ URL::route('excel') }}" class="btn btn-warning col-xs-4 col-sm-4"><i class="fa fa-arrow-left fa-fw"></i> Volver atras</a>
@stop