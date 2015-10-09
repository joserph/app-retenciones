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
                    <h3 class="panel-title">Reportes Z del Mes</h3>
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
                            $totalMonto1 = 0;
                            $totalExento1 = 0;
                            $totalImpuesto1 = 0;
                            ?>
                            @foreach($ventas as $item)
                                @if(date('m', strtotime($item->fecha_z)) == $mes)
                                    <tr>
                                        <td>{{ $contador += 1 }}</td>           
                                        <td>{{ date("d/m/Y", strtotime($item->fecha_z)) }}</td>      
                                        <td>{{ number_format($totalMonto1,2,",",".") }}</td> 
                                        <td>{{ number_format($totalExento1,2,",",".") }}</td>   
                                        <td>{{ number_format($totalImpuesto1,2,",",".") }}</td>
                                        @if(Auth::check())                      
                                            <td>            
                                                <a href="{{ route('ventas.show', $item->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye fa-fw"></i> Ver</a>                        
                                                <a href="{{ route('ventas.edit', $item->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</a>                             
                                            </td>
                                        @endif                                                                   
                                    </tr>
                                @endif
                                <?php
                                    $total1 += $totalMonto1;
                                    $total2 += $totalExento1;
                                    $total3 += $totalImpuesto1;
                                ?>
                            @endforeach                         
                                <tr class="active">
                                    <td></td>
                                    <td><strong>Total Monto:</strong></td>
                                    <td><strong>{{ number_format($total1,2,",",".") }}</strong></td>
                                </tr>   
                                <tr class="active">
                                    <td></td>
                                    <td><strong>Total Exento:</strong></td>
                                    <td></td>
                                    <td><strong>{{ number_format($total2,2,",",".") }}</strong></td>
                                </tr>   
                                <tr class="active">
                                    <td></td>
                                    <td><strong>Total Impuesto:</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>{{ number_format($total3,2,",",".") }}</strong></td>
                                </tr>                        
                        </table>    
                    </div>              
                </div>
            </div>
        </div>
    </div>
@stop