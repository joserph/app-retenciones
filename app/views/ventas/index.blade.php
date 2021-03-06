@extends('master.layout')
@section ('title') Ventas de {{ $agente->nombre }} | App-Retenciones @stop
@section('content')
   
    <legend><h3><i class="fa fa-usd fa-fw"></i> Ventas de {{ $agente->nombre }}</h3></legend>
    <ul class="breadcrumb">
        <li><a href="{{ URL::route('home') }}">Inicio</a></li>
        <li class="active">Ventas de {{ $agente->nombre }}</li>
    </ul>
    <?php
        $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
        $mesActual = date('n');
    ?>
    <!-- Calculos -->
    <!-- Fin Compras del mes en curso -->
        <!-- ***********************//////////////////////////////****************************** -->
        <!-- Calculo del mes anterior -->
        
        <!-- Variables -->        
        <?php                                
            $totalImpuestoVentasAnterior = 0;                            
            $impuestoVentasAnterior = 0;
            $totalImpuestoComprasAnterior = 0;                                                   
            $ImpuestoComprasAnterior = 0;
            $totalImpuestoVentasActual = 0;
            $impuestoVentasActual = 0;
            $totalImpuestoComprasActual =0;
            $ImpuestoComprasActual = 0;
        ?>
        <!-- Fin Variables -->
        <!-- Reportes de ventas del mes anterior -->
        @foreach($ventas as $item)
            @if(date('m-Y', strtotime($item->fecha_z)) == $anteriorX2)
                <?php
                    $impuestoVentasAnterior = $item->venta()->where('id_fecha', '=', $item->id)->sum('impuesto');
                    $totalImpuestoVentasAnterior += $impuestoVentasAnterior;
                ?>
            @endif                               
        @endforeach                
        <!-- Fin Reportes de ventas del mes anterior -->

        <!-- Reporte de compras del mes anterior -->
        @foreach($reportesTodos as $item)                                
            @if(date('m-Y', strtotime($item->fecha)) == $anteriorX2)
                <?php
                    $ImpuestoComprasAnterior = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');
                    $totalImpuestoComprasAnterior += $ImpuestoComprasAnterior;
                ?>                                    
            @endif                                    
        @endforeach
        <!-- Fin Reporte de compras del mes anterior -->

        <!-- Reporte de compras del mes anterior -->
        @if($mesActual == 1)
            <?php
                $fechaAnteriorDos = 13;
                $fechaAnterior = 12;                           
            ?>
        @else
            <?php
                $fechaAnteriorDos = $mesActual - 1;
                $fechaAnterior = $mesActual - 1;                            
            ?>
        @endif
        @if($mesActual == 2)
            <?php
                $balanceMesAnterior = 0;
            ?>
        @else                        
        <?php                                
            $balanceMesAnterior = $totalImpuestoVentasAnterior - $totalImpuestoComprasAnterior;                              
        ?>                 
        @endif
        <!-- Fin Reporte de compras del mes anterior -->

        <!-- Reportes de ventas del mes actual -->
        @foreach($ventas as $item)
            @if(date('m-Y', strtotime($item->fecha_z)) == $anterior)
                <?php
                    $impuestoVentasActual = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                    $totalImpuestoVentasActual += $impuestoVentasActual;
                ?>                                    
            @endif
        @endforeach
        <!-- Fin Reportes de ventas del mes actual -->

        <!-- Reporte de compras del mes actual -->
        @foreach($reportesTodos as $item)                                
            @if(date('m-Y', strtotime($item->fecha)) == $anterior)
                <?php
                    $ImpuestoComprasActual = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');
                    $totalImpuestoComprasActual += $ImpuestoComprasActual;
                ?>
            @endif                                    
        @endforeach
        <!-- Fin Reporte de compras del mes actual -->

        <!-- Reporte de compras del mes actual -->                    
        <?php                                
            $balanceMesActual = $totalImpuestoVentasActual - $totalImpuestoComprasActual;                                     
        ?>                     
        <!-- Fin Reporte de compras del mes actual -->

        <!-- Estimado a pagar -->
        <?php
            if($balanceMesAnterior > 0)
            {
                $balanceMesAnterior = 0;
            }
            $estimado = $balanceMesAnterior + $balanceMesActual;
        ?>        
            
        <!-- Fin Estimado a pagar -->        
    <!-- End calculos -->
    <div>
        @if(Auth::check())
    	    <h1>
                <a href="{{ route('ventas.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="top" title="Agregar reporte de venta"><i class="fa fa-plus-circle fa-fw"></i> Agregar venta</a>
            </h1>            
            <h1>
                <a href="{{ route('all-ventas.index') }}" class="btn btn-info col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="top" title="Ver todos los reportes de venta"><i class="fa fa-eye fa-fw"></i> Todas las venta</a>
            </h1>           
        @endif
    </div>
    <br>
    <hr>
   
    <div>
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mes actual</a></li>
            @if($mes != 1)
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Mes anterior</a></li>
            @endif
        </ul>
    
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <!-- Ventas del mes en curso -->
                <div class="row">        
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading text-center">
                                <i class="fa fa-usd fa-5x"></i>
                                <h3 class="panel-title">Reportes de ventas de <span class="text-capitalize">{{ $meses[$mesActual - 1] }}</span></h3>
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
                                            @if(Auth::check())
                                                <th>Acciones</th>    
                                            @endif                      
                                        </tr>
                                        <?php 
                                            $totalMonto = 0;
                                            $totalExento = 0;
                                            $totalImpuesto = 0;
                                            $monto = 0;
                                            $exento = 0;
                                            $impuesto = 0;
                                        ?>
                                        @foreach($ventas as $item)
                                            @if(date('m-Y', strtotime($item->fecha_z)) == $actual)
                                                <?php
                                                    $monto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('total_v');
                                                    $exento = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('exento');
                                                    $impuesto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                                                    $totalMonto += $monto;
                                                    $totalExento += $exento;
                                                    $totalImpuesto += $impuesto;
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
                <!-- Fin Ventas del mes en curso -->
            <!-- ***********************//////////////////////////////****************************** -->
                <!-- Compras del mes en curso -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                <i class="fa fa-file-pdf-o fa-5x"></i>
                                <h3 class="panel-title">Reportes de compras de <span class="text-capitalize">{{ $meses[$mesActual - 1] }}</span></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-responsive">      
                                        <tr class="success">
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Comprobante</th>
                                            <th>Monto</th> 
                                            <th>Exento</th>
                                            <th>Impuesto</th>                          
                                        </tr>
                                        <?php
                                            $contador = 0;
                                            $totalCompra = 0;
                                            $totalExentos = 0;
                                        ?>
                                        @foreach($reportesTodos as $item)                                
                                            @if(date('m-Y', strtotime($item->fecha)) == $actual)
                                                <?php
                                                    $compras = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('total_compra');
                                                    $totalCompra += $compras;
                                                    $exentos = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('exento');
                                                    $totalExentos += $exentos;
                                                    $totalFacturas = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');
                                                    $totalImpuestoMes += $totalFacturas;
                                                ?>                                                
                                                <tr>
                                                    <td>{{ $contador += 1 }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->fecha)) }}</td>
                                                    <td>{{ $item->n_comp }}</td>                                                    
                                                    <td>{{ number_format($compras,2,",",".") }}</td>                                                        
                                                    <td>{{ number_format($exentos,2,",",".") }}</td>
                                                    <td>{{ number_format($totalFacturas,2,",",".") }}</td>
                                                </tr>                                                
                                            @endif                                    
                                        @endforeach
                                        <tr class="active">
                                            <td></td>
                                            <td><strong>Total Compra:</strong></td>
                                            <td></td>
                                            <td><strong>{{ number_format($totalCompra,2,",",".") }}</strong></td>
                                        </tr>
                                        <tr class="active">
                                            <td></td>
                                            <td><strong>Total Exento:</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>{{ number_format($totalExentos,2,",",".") }}</strong></td>
                                        </tr>
                                        <tr class="active">
                                            <td></td>
                                            <td><strong>Total Impuesto:</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>{{ number_format($totalImpuestoMes,2,",",".") }}</strong></td>
                                        </tr>
                                    </table>
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Compras del mes en curso -->
            <!-- ***********************//////////////////////////////****************************** -->
                <!-- Calculo del mes anterior -->
                <div class="row">
                    <!-- Variables -->        
                    <?php                                
                        $totalImpuestoVentasActual = 0;
                        $impuestoVentasActual = 0;
                        $totalImpuestoComprasActual =0;
                        $ImpuestoComprasActual = 0;
                    ?>
                    <!-- Fin Variables -->
                    

                    <!-- Reporte de compras del mes anterior -->
                    
                    <div class="col-md-4">

                        <div class="jumbotron">
                            <h4 class="text-center">Balance del Impuesto en Compras y Ventas de <span class="text-capitalize">{{ $meses[$fechaAnterior - 1] }}</span></h4>
                                           
                            @if($estimado >= 0)
                                <?php
                                    $estimado = 0;
                                ?>
                                <div class="alert alert-dismissable alert-success">                
                                    <p class="lead text-center"><em>{{ number_format($estimado,2,",",".") }}</em></p>                
                                </div>    
                            @else 
                                <div class="alert alert-dismissable alert-danger">                
                                    <p class="lead text-center"><em>{{ number_format($estimado,2,",",".") }}</em></p>                
                                </div> 
                            @endif                                            
                        </div>
                    </div>
                    <!-- Fin Reporte de compras del mes anterior -->

                    <!-- Reportes de ventas del mes actual -->
                    @foreach($ventas as $item)
                        @if(date('m-Y', strtotime($item->fecha_z)) == $actual)
                            <?php
                                $impuestoVentasActual = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                                $totalImpuestoVentasActual += $impuestoVentasActual;
                            ?>                                    
                        @endif
                    @endforeach
                    <!-- Fin Reportes de ventas del mes actual -->

                    <!-- Reporte de compras del mes actual -->
                    @foreach($reportesTodos as $item)                                
                        @if(date('m-Y', strtotime($item->fecha)) == $actual)
                            <?php
                                $ImpuestoComprasActual = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');
                                $totalImpuestoComprasActual += $ImpuestoComprasActual;
                            ?>
                        @endif                                    
                    @endforeach
                    <!-- Fin Reporte de compras del mes actual -->

                    <!-- Reporte de compras del mes actual -->
                    <div class="col-md-4">
                        <div class="jumbotron">
                            <h4 class="text-center">Balance del Impuesto en Compras y Ventas de <span class="text-capitalize">{{ $meses[$mesActual - 1] }}</span></h4>
                            <?php                                
                                $balanceMesActual = $totalImpuestoVentasActual - $totalImpuestoComprasActual;                                     
                            ?>                
                            @if($balanceMesActual >= 0)
                                <div class="alert alert-dismissable alert-success">                
                                    <p class="lead text-center"><em>{{ number_format($balanceMesActual,2,",",".") }}</em></p>                
                                </div>    
                            @else 
                                <div class="alert alert-dismissable alert-danger">                
                                    <p class="lead text-center"><em>{{ number_format($balanceMesActual,2,",",".") }}</em></p>                
                                </div> 
                            @endif                                            
                        </div>
                    </div>
                    <!-- Fin Reporte de compras del mes actual -->

                    <!-- Estimado a pagar -->
                    <?php
                        $estimadoHoy = $estimado + $balanceMesActual;
                    ?>  
                    <div class="col-md-4">
                        <div class="jumbotron">
                            <h4 class="text-center">Estimado a pagar en <span class="text-capitalize">{{ $meses[$mesActual - 1] }}</span></h4>
                                @if($estimadoHoy >= 0)
                                    <div class="alert alert-dismissable alert-success">                
                                        <p class="lead text-center"><em>{{ number_format($estimadoHoy,2,",",".") }}</em></p>                
                                    </div>    
                                @else 
                                    <div class="alert alert-dismissable alert-danger">                
                                        <p class="lead text-center"><em>{{ number_format($estimadoHoy,2,",",".") }}</em></p>                
                                    </div> 
                                @endif   
                        </div>
                    </div>        
                    <!-- Fin Estimado a pagar -->        
                </div>
            </div>

<!-- ***********************//////////////// OTRO MES //////////////****************************** -->

            <div role="tabpanel" class="tab-pane" id="profile">
                <!-- Ventas del mes en curso -->
                <div class="row">        
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading text-center">
                                <i class="fa fa-usd fa-5x"></i>

                                <h3 class="panel-title">Reportes de ventas de <span class="text-capitalize">{{ $meses[$fechaAnterior - 1] }}</span></h3>
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
                                            @if(Auth::check())
                                                <th>Acciones</th>   
                                            @endif                       
                                        </tr>
                                        <?php 
                                            $totalMonto = 0;
                                            $totalExento = 0;
                                            $totalImpuesto = 0;
                                            $monto = 0;
                                            $exento = 0;
                                            $impuesto = 0;
                                            $contador = 0;
                                        ?>
                                        @foreach($ventas as $item)
                                            @if(date('m-Y', strtotime($item->fecha_z)) == $anterior)
                                                <?php
                                                    $monto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('total_v');
                                                    $exento = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('exento');
                                                    $impuesto = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                                                    $totalMonto += $monto;
                                                    $totalExento += $exento;
                                                    $totalImpuesto += $impuesto;
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
                <!-- Fin Ventas del mes en curso -->
                <!-- ***********************//////////////////////////////****************************** -->
                <!-- Compras del mes en curso -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                <i class="fa fa-file-pdf-o fa-5x"></i>
                                <h3 class="panel-title">Reportes de compras de <span class="text-capitalize">{{ $meses[$fechaAnterior - 1] }}</span></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-responsive">      
                                        <tr class="success">
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Comprobante</th>
                                            <th>Monto</th> 
                                            <th>Exento</th>
                                            <th>Impuesto</th>                       
                                        </tr>
                                        <?php
                                            $contador = 0;
                                            $totalFacturas = 0;
                                            $totalImpuestoMes = 0;
                                            $totalCompra = 0;
                                            $totalExentos = 0;
                                        ?>
                                        @foreach($reportesTodos as $item)                                
                                            @if(date('m-Y', strtotime($item->fecha)) == $anterior)
                                                <?php
                                                    $compras = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('total_compra');
                                                    $totalCompra += $compras;
                                                    $exentos = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('exento');
                                                    $totalExentos += $exentos;
                                                    $totalFacturas = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');
                                                    $totalImpuestoMes += $totalFacturas;
                                                ?>                                                
                                                <tr>
                                                    <td>{{ $contador += 1 }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($item->fecha)) }}</td>
                                                    <td>{{ $item->n_comp }}</td>                                                    
                                                    <td>{{ number_format($compras,2,",",".") }}</td>                                                        
                                                    <td>{{ number_format($exentos,2,",",".") }}</td>
                                                    <td>{{ number_format($totalFacturas,2,",",".") }}</td>
                                                </tr>                                                
                                            @endif                                    
                                        @endforeach
                                        <tr class="active">
                                            <td></td>
                                            <td><strong>Total Compra:</strong></td>
                                            <td></td>
                                            <td><strong>{{ number_format($totalCompra,2,",",".") }}</strong></td>
                                        </tr>
                                        <tr class="active">
                                            <td></td>
                                            <td><strong>Total Exento:</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>{{ number_format($totalExentos,2,",",".") }}</strong></td>
                                        </tr>
                                        <tr class="active">
                                            <td></td>
                                            <td><strong>Total Impuesto:</strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>{{ number_format($totalImpuestoMes,2,",",".") }}</strong></td>
                                        </tr>
                                    </table>
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Compras del mes en curso -->
                <!-- ***********************//////////////////////////////****************************** -->
                <!-- Calculo del mes anterior -->
                <div class="row">
                    <!-- Variables -->        
                    <?php                                
                        $totalImpuestoVentasAnterior = 0;                            
                        $impuestoVentasAnterior = 0;
                        $totalImpuestoComprasAnterior = 0;                                                   
                        $ImpuestoComprasAnterior = 0;
                        $totalImpuestoVentasActual = 0;
                        $impuestoVentasActual = 0;
                        $totalImpuestoComprasActual =0;
                        $ImpuestoComprasActual = 0;
                    ?>
                    <!-- Fin Variables -->
                    <!-- Reportes de ventas del mes anterior -->
                    @foreach($ventas as $item)
                        @if(date('m-Y', strtotime($item->fecha_z)) == $anteriorX2)
                            <?php
                                $impuestoVentasAnterior = $item->venta()->where('id_fecha', '=', $item->id)->sum('impuesto');
                                $totalImpuestoVentasAnterior += $impuestoVentasAnterior;
                            ?>
                        @endif                               
                    @endforeach                
                    <!-- Fin Reportes de ventas del mes anterior -->

                    <!-- Reporte de compras del mes anterior -->
                    @foreach($reportesTodos as $item)                                
                        @if(date('m-Y', strtotime($item->fecha)) == $anteriorX2)
                            <?php
                                $ImpuestoComprasAnterior = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');
                                $totalImpuestoComprasAnterior += $ImpuestoComprasAnterior;
                            ?>                                    
                        @endif                                    
                    @endforeach
                    <!-- Fin Reporte de compras del mes anterior -->

                    <!-- Reporte de compras del mes anterior -->
                    @if($mesActual == 1)
                        <?php
                            $fechaAnteriorDos = 13;
                            $fechaAnterior = 12;                           
                        ?>
                    @else
                        <?php
                            $fechaAnteriorDos = $mesActual - 1;
                            $fechaAnterior = $mesActual - 1;                            
                        ?>
                    @endif
                    @if($mesActual == 2)
                        <?php
                            $balanceMesAnterior = 0;
                        ?>
                    @else
                        <div class="col-md-4">

                            <div class="jumbotron">
                                <h4 class="text-center">Balance del Impuesto en Compras y Ventas de <span class="text-capitalize">{{ $meses[$fechaAnteriorDos - 2] }}</span></h4>
                                <?php                                
                                    $balanceMesAnterior = $totalImpuestoVentasAnterior - $totalImpuestoComprasAnterior;                              
                                ?>               
                                @if($balanceMesAnterior >= 0)
                                    <?php
                                        $balanceMesAnterior = 0;
                                    ?>
                                    <div class="alert alert-dismissable alert-success">                
                                        <p class="lead text-center"><em>{{ number_format($balanceMesAnterior,2,",",".") }}</em></p>                
                                    </div>    
                                @else 
                                    <div class="alert alert-dismissable alert-danger">                
                                        <p class="lead text-center"><em>{{ number_format($balanceMesAnterior,2,",",".") }}</em></p>                
                                    </div> 
                                @endif                                            
                            </div>
                        </div>
                    @endif
                    <!-- Fin Reporte de compras del mes anterior -->

                    <!-- Reportes de ventas del mes actual -->
                    @foreach($ventas as $item)
                        @if(date('m-Y', strtotime($item->fecha_z)) == $anterior)
                            <?php
                                $impuestoVentasActual = DB::table('reportesventas')->where('id_fecha', '=', $item->id)->sum('impuesto');
                                $totalImpuestoVentasActual += $impuestoVentasActual;
                            ?>                                    
                        @endif
                    @endforeach
                    <!-- Fin Reportes de ventas del mes actual -->

                    <!-- Reporte de compras del mes actual -->
                    @foreach($reportesTodos as $item)                                
                        @if(date('m-Y', strtotime($item->fecha)) == $anterior)
                            <?php
                                $ImpuestoComprasActual = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('impuesto_iva');
                                $totalImpuestoComprasActual += $ImpuestoComprasActual;
                            ?>
                        @endif                                    
                    @endforeach
                    <!-- Fin Reporte de compras del mes actual -->

                    <!-- Reporte de compras del mes actual -->
                    <div class="col-md-4">
                        <div class="jumbotron">
                            <h4 class="text-center">Balance del Impuesto en Compras y Ventas de <span class="text-capitalize">{{ $meses[$fechaAnterior - 1] }}</span></h4>
                            <?php                                
                                $balanceMesActual = $totalImpuestoVentasActual - $totalImpuestoComprasActual;                                     
                            ?>                
                            @if($balanceMesActual >= 0)
                                <div class="alert alert-dismissable alert-success">                
                                    <p class="lead text-center"><em>{{ number_format($balanceMesActual,2,",",".") }}</em></p>                
                                </div>    
                            @else 
                                <div class="alert alert-dismissable alert-danger">                
                                    <p class="lead text-center"><em>{{ number_format($balanceMesActual,2,",",".") }}</em></p>                
                                </div> 
                            @endif                                            
                        </div>
                    </div>
                    <!-- Fin Reporte de compras del mes actual -->

                    <!-- Estimado a pagar -->
                    <?php
                        $estimado = $balanceMesAnterior + $balanceMesActual;
                    ?>        
                    <div class="col-md-4">

                        <div class="jumbotron">
                            <h4 class="text-center">Estimado a pagar en <span class="text-capitalize">{{ $meses[$fechaAnterior - 1] }}</span></h4>
                                @if($estimado >= 0)
                                    <div class="alert alert-dismissable alert-success">                
                                        <p class="lead text-center"><em>{{ number_format($estimado,2,",",".") }}</em></p>                
                                    </div>    
                                @else 
                                    <div class="alert alert-dismissable alert-danger">                
                                        <p class="lead text-center"><em>{{ number_format($estimado,2,",",".") }}</em></p>                
                                    </div> 
                                @endif   
                        </div>
                    </div>        
                    <!-- Fin Estimado a pagar -->        
                </div>
            </div>
        </div>
    </div>
@stop
