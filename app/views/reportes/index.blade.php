@extends('master.layout')
@section ('title') Lista de Retenciones I.V.A. | App-Retenciones @stop
@section('content')

    <legend><h3><i class="fa fa-file-pdf-o fa-fw"></i> Retenciones I.V.A.</h3></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Lista de Retenciones I.V.A.</li>
    </ul>
    @if(Auth::check())
        <div>        
           <h1>
                <a href="{{ route('reportes.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="top" title="Crear reporte de retención I.V.A."><i class="fa fa-plus-circle fa-fw"></i> Crear reporte</a>
            </h1>
            <h1>
                <a href="{{ route('excel') }}" class="btn btn-primary col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="top" title="Generar corte de quincena"><i class="fa fa-scissors fa-fw"></i> Generar corte</a>
            </h1>        
        </div>
        <br>
        <hr>
    @endif
    @if($totalReportes > 10)
        {{ Form::open(array('url' => '/reportes', 'method' => 'GET', 'role' => 'form', 'class' => 'form-horizontal')) }}
            <div class="input-group">
                {{ Form::text('buscar', null, array('class' => 'form-control', 'placeholder' => 'Buscar reporte', 'autofocus'=>'autofocus')) }}
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search fa-fw"></i></span></button> 
                </span>
            </div>
        {{ Form::close() }}
        <hr>
    @endif
    
    @if($totalReportes > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover table-responsive">
                <tr>
                    <th>#</th>
                    <th class="text-center">Nº Comprobante</th>
                    <th class="text-center">Fecha</th>  
                    <th class="text-center">Periodo</th>
                    <th class="text-center">Agente</th>
                    <th class="text-center">Proveedor</th>
                    @if(Auth::check())
                        <th class="text-center">Acción</th>
                    @endif
                </tr>
                <?php $cont = 0;?>
                @foreach ($reportes as $reporte)
                <tr>
                    <td>{{ $cont += 1 }}</td>
                    <td class="text-center">{{ $reporte->n_comp }}</td>
                    <td class="text-center">{{ date("d/m/Y", strtotime($reporte->fecha)) }}</td>
                    <td class="text-center">{{ date("m-Y", strtotime($reporte->periodo)) }}</td>                   
                    <td class="text-center">{{ $agente->nombre }}</td>                        
                    @foreach($proveedores as $proveedor)
                        @if($proveedor->id == $reporte->id_proveedor)
                            <td class="text-center">{{ $proveedor->nombre }}</td>
                        @endif
                    @endforeach
                    @if(Auth::check())                      
                        <td class="text-center">            
                            <a href="{{ route('reportes.show', $reporte->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>                        
                            <a href="{{ route('reportes.edit', $reporte->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>                        
                        </td>
                    @endif     
                   
                </tr>
                @endforeach
            </table>
        </div>
    @endif
    {{ $reportes->appends(array('buscar' => Input::get('buscar')))->links() }}
@stop