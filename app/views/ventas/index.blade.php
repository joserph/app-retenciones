@extends('master.layout')
@section ('title') Ventas de {{ $agente->nombre }} | App-Retenciones @stop
@section('content')
   
    <legend><h2><i class="fa fa-money fa-fw"></i> Ventas de {{ $agente->nombre }}</h2></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Ventas de {{ $agente->nombre }}</li>
    </ul>
    <div>
        @if(Auth::check())
    	   <h1>
                <a href="{{ route('ventas.create') }}" class="btn btn-success col-xs-6 col-sm-6"><i class="fa fa-plus-circle fa-fw"></i> Agregar venta</a>
            </h1>
        @endif
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-warning">
                <div class="panel-heading text-center">
                    <i class="fa fa-indent fa-5x"></i>
                    <h3 class="panel-title">Reportes de ventas del mes</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <tr class="warning">
                                <th>#</th>
                                <th>Fecha</th>                                
                                <th>Monto</th> 
                                <th>Exento</th>
                                <th>Impuesto</th>
                                <th>Acciones</th>                          
                            </tr>
                            <?php 
                                $total1 = 0;
                                $total2 = 0;
                                $total3 = 0;
                                $totalMonto = 0;
                                $totalExento = 0;
                                $totalImpuesto = 0;
                            ?>
                            @foreach($ventas as $item)
                                @if((date('m', strtotime($item->fecha_z)) == $mes) && (date('Y', strtotime($item->fecha_z)) == $anio))
                                    <?php
                                        $monto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('total_v');
                                        $exento = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('exento');
                                        $impuesto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                                    ?>
                                    <tr>
                                        <td>{{ $contador += 1 }}</td>           
                                        <td>{{ date("d/m/Y", strtotime($item->fecha_z)) }}</td>      
                                        <td>{{ number_format($monto,2,",",".") }}</td> 
                                        <td>{{ number_format($exento,2,",",".") }}</td>   
                                        <td>{{ number_format($impuesto,2,",",".") }}</td>
                                        @if(Auth::check())                      
                                            <td>            
                                                <a href="{{ route('ventas.show', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>                 
                                                <a href="{{ route('ventas.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>               
                                            </td>
                                        @endif                                                                   
                                    </tr>
                                @endif
                                <?php
                                    $totalMonto += $monto;
                                    $totalExento += $exento;
                                    $totalImpuesto += $impuesto;
                                ?>
                            @endforeach                         
                                <tr class="active">
                                    <td></td>
                                    <td><strong>Total Monto:</strong></td>
                                    <td><strong>{{ number_format($totalMonto,2,",",".") }}</strong></td>
                                </tr>   
                                <tr class="active">
                                    <td></td>
                                    <td><strong>Total Exento:</strong></td>
                                    <td></td>
                                    <td><strong>{{ number_format($totalExento,2,",",".") }}</strong></td>
                                </tr>   
                                <tr class="active">
                                    <td></td>
                                    <td><strong>Total Impuesto:</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>{{ number_format($totalImpuesto,2,",",".") }}</strong></td>
                                </tr>                        
                        </table>    
                    </div>              
                </div>
            </div>
        </div>
    </div>
@stop