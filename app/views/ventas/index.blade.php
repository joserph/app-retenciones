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
                                $monto = 0;
                                $exento = 0;
                                $impuesto = 0;
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
        <div class="panel-footer">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <tr class="success">
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Comprobante</th>
                                <th>Proveedor</th> 
                                <th>Monto</th>                           
                            </tr>
                            <?php
                                $contador = 0;
                            ?>
        @foreach($reportesTodos as $item)                                
            @if(date('m', strtotime($item->fecha)) == $mes && date('Y', strtotime($item->fecha)) == $anio)
                <?php
                    $totalFacturas = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('total_compra');
                ?>
                @if(date('d', strtotime($item->fecha)) <= 15)
                    <tr class="active">
                        <td>{{ $contador += 1 }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->fecha)) }}</td>
                        <td>{{ $item->n_comp }}</td>
                        @foreach($proveedores as $proveedor)
                            @if(($proveedor->id) == ($item->id_proveedor))
                                <td>{{ $proveedor->nombre }}</td>
                            @endif
                        @endforeach
                        <td>{{ number_format($totalFacturas,2,",",".") }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $contador += 1 }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->fecha)) }}</td>
                        <td>{{ $item->n_comp }}</td>
                        @foreach($proveedores as $proveedor)
                            @if(($proveedor->id) == ($item->id_proveedor))
                                <td>{{ $proveedor->nombre }}</td>
                            @endif
                        @endforeach
                        <td>{{ number_format($totalFacturas,2,",",".") }}</td>
                    </tr>
                @endif
                <?php
                    $totalImpuestoMes += $totalFacturas;
                ?>
            @endif                                    
        @endforeach
          <tr class="active">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total mes:</strong></td>
                                    <td><strong>{{ number_format($totalImpuestoMes,2,",",".") }}</strong></td>
                                </tr>
                        </table>
                    </div>
                
    </div>
       </div>

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
                                    <th>Meses</th>                                    
                                    <th>Impuesto Ventas</th>
                                    <th></th>
                                    <th>Impiesto Compras</th>
                                    <th></th>
                                    <th>Pago Estimano</th>
                                </tr>
                                <?php
                                    $totalImpuesto = 0;
                                    $totalImpuestoMes = 0;
                                    $aux = 0;
                                    $diferencia = 0;
                                ?>
                                @for($i = 1; $i <= 12; $i++)
                                    <!--Resta en caso de ser negativo-->
                                    @if($diferencia < 0)
                                        @foreach($reportesTodos as $item)                                                    
                                            @if(date('m', strtotime($item->fecha)) == ($i-1) && date('Y', strtotime($item->fecha)) == $anio)
                                                <?php
                                                    $totalImpuestoCompra = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');                  
                                                    $totalImpuestoMes += $totalImpuestoCompra;
                                                ?>
                                            @endif                                   
                                        @endforeach
                                        @foreach($ventas as $item)                              
                                            @if(date('m', strtotime($item->fecha_z)) == ($i-1) && date('Y', strtotime($item->fecha_z)) == $anio)
                                                <?php                                            
                                                    $impuesto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                                                    $totalImpuesto += $impuesto;
                                                ?>
                                            @endif
                                        @endforeach
                                        <?php
                                            $aux = $totalImpuesto - $totalImpuestoMes;
                                        ?>
                                    @endif
                                    <!--Fin Resta en caso de ser negativo-->

                                    @foreach($reportesTodos as $item)                                                    
                                        @if(date('m', strtotime($item->fecha)) == $i && date('Y', strtotime($item->fecha)) == $anio)
                                            <?php
                                                $totalImpuestoCompra = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');                      
                                                $totalImpuestoMes += $totalImpuestoCompra;
                                            ?>
                                        @endif                                   
                                    @endforeach
                                    @foreach($ventas as $item)                              
                                        @if(date('m', strtotime($item->fecha_z)) == $i && date('Y', strtotime($item->fecha_z)) == $anio)
                                            <?php                                            
                                                $impuesto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                                                $totalImpuesto += $impuesto;
                                            ?>
                                        @endif
                                    @endforeach
                                    <?php
                                        $diferencia = $totalImpuesto - $totalImpuestoMes;
                                    ?>
                                    
                                    <tr>
                                        <td>{{ $i }}</td>                                    
                                        <td>{{ number_format($totalImpuesto,2,",",".") }}</td>
                                        <td>-</td>
                                        <td>{{ number_format($totalImpuestoMes,2,",",".") }}</td>
                                        <td>=</td>
                                        <td>{{ number_format($diferencia,2,",",".") }}</td>
                                    </tr>
                                    <?php
                                        $totalImpuesto = 0;
                                        $totalImpuestoMes = 0;
                                        $aux = 0;
                                    ?>
                                @endfor
                            </table>
                        </div>
                    </div>
                </div>
           </div>
       </div>
@section('script')
    {{ HTML::script('assets/js/Chart.js') }}
@stop
@stop
