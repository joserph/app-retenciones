@extends('master.layout')
@if($totalAgente == 0)
    @section ('title') App-Retenciones @stop
@else
    @section ('title') {{ $agente->nombre }} | App-Retenciones @stop
@endif
@section('content')
    <p>{{ $mensaje }}</p>
	<legend>
		<h1 class="text-center ussr">Sistema de Retenciones I.V.A. - I.S.L.R.</h1>
		@if($totalAgente == 0)
			
		@else
			<h2 class="text-center"><i class="fa fa-building fa-fw"></i> {{ $agente->nombre }}</h2>
		@endif		
	</legend>
    @if(Auth::check())
        <a href="{{ route('reportes.create') }}" class="btn btn-success"><i class="fa fa-plus-circle fa-fw"></i> Crear reporte I.V.A.</a>
        <hr>
    @endif
	@if($iva != 'vencido')
	<div class="row">
        <!--I.V.A. actual-->
		<div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $iva->iva }}%</div>
                            <div>I.V.A. Actual!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('iva.index') }}" data-toggle="tooltip" data-placement="bottom" title="Ver historial del I.V.A.">
                    <div class="panel-footer">
                        <span class="pull-left"><i class="fa fa-eye fa-fw"></i> Ver Detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!--Fin I.V.A. actual-->
        @elseif(Auth::check())
            <h1><a href="{{ route('iva.create') }}" class="btn btn-success col-xs-6 col-sm-6" data-toggle="tooltip" data-placement="right" title="Agregar I.V.A."><i class="fa fa-plus-circle fa-fw"></i> Agregar I.V.A.</a></h1>
        @endif  
        <!--Retenciones I.V.A. de hoy-->
        <div class="col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-pdf-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">Retenciones I.V.A.</div>
                            <div>Hoy {{ date('d/m/Y', strtotime($hoy)) }}</div>
                        </div>
                    </div>
                </div>                
                <div class="panel-footer">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <tr class="warning">
                                <th>#</th>
                                <th>Comprobante</th>
                                <th>Proveedor</th> 
                                <th>Monto</th>                           
                            </tr>
                            <?php
                                $totalFacturas = 0;
                            ?>
                            @foreach($reportesIva as $item)
                                <?php
                                    $totalFacturas = DB::table('facturas')->where('id_reporte', '=', $item->id)->sum('total_compra');
                                    $totalDia += $totalFacturas;
                                ?>
                                <tr>
                                    <td>{{ $contador += 1 }}</td>
                                    <td>{{ $item->n_comp }}</td>
                                    @foreach($proveedores as $proveedor)
                                        @if(($proveedor->id) == ($item->id_proveedor))
                                            <td>{{ $proveedor->nombre }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ number_format($totalFacturas,2,",",".") }}</td>
                                </tr>
                            @endforeach
                                <tr class="active">
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total hoy:</strong></td>
                                    <td><strong>{{ number_format($totalDia,2,",",".") }}</strong></td>
                                </tr>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
        <!--Fin Retenciones I.V.A. de hoy-->
        <!--Retenciones I.V.A. del mes-->
        <?php
            $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
            $mesActual = date('n');
        ?>
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <i class="fa fa-calendar fa-5x"></i>
                    <h3 class="panel-title">Retenciones I.V.A. de <span class="text-capitalize">{{ $meses[$mesActual - 1] }}</span></h3>
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
                                        <tr class="info">
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
                                    @endif
                                    <?php
                                        $totalMes += $totalFacturas;
                                    ?>
                                @endif                                    
                            @endforeach
                                <tr class="active">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total mes:</strong></td>
                                    <td><strong>{{ number_format($totalMes,2,",",".") }}</strong></td>
                                </tr>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
        <!--Fin Retenciones I.V.A. del mes-->

        <!-- Retenciones ISLR de hoy -->
        <div class="col-md-6">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-pdf-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">Retenciones I.S.L.R.</div>
                            <div>Hoy {{ date('d/m/Y', strtotime($hoy)) }}</div>
                        </div>
                    </div>
                </div>                
                <div class="panel-footer">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-responsive">
                            <tr class="warning">
                                <th>#</th>
                                <th>Comprobante</th>
                                <th>Proveedor</th> 
                                <th>Monto</th>                           
                            </tr>
                            <?php
                                $contador = 0;
                                $sumFactIslr = 0;
                                $totalFactIslr = 0;
                            ?>
                            @foreach($reportesIslr as $item)
                                <?php
                                    $sumFactIslr = DB::table('facturasislr')->where('id_reporteislr', '=', $item->id)->sum('total_compra');
                                    $totalFactIslr += $sumFactIslr;
                                ?>
                                <tr>
                                    <td>{{ $contador += 1 }}</td>
                                    <td>{{ $item->n_comp }}</td>
                                    @foreach($empleados as $empleado)
                                        @if(($empleado->id) == ($item->id_empleado))
                                            <td>{{ $empleado->nombre }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ number_format($sumFactIslr,2,",",".") }}</td>
                                </tr>
                            @endforeach
                                <tr class="active">
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total hoy:</strong></td>
                                    <td><strong>{{ number_format($totalFactIslr,2,",",".") }}</strong></td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Retenciones ISLR de hoy -->

        <!-- Retenciones ISLR del mes -->
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <i class="fa fa-calendar fa-5x"></i>
                    <h3 class="panel-title">Retenciones I.S.L.R. de <span class="text-capitalize">{{ $meses[$mesActual - 1] }}</span></h3>
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
                                $sumFactIslrMes = 0;
                                $totalFactIslrMes = 0;
                            ?>
                            @foreach($reportesIslrTodos as $item)                                
                                @if(date('m', strtotime($item->fecha)) == $mes && date('Y', strtotime($item->fecha)) == $anio)
                                    <?php
                                        $sumFactIslrMes = DB::table('facturasislr')->where('id_reporteislr', '=', $item->id)->sum('total_compra');
                                        $totalFactIslrMes += $sumFactIslrMes;
                                    ?>                                    
                                    <tr class="active">
                                        <td>{{ $contador += 1 }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item->fecha)) }}</td>
                                        <td>{{ $item->n_comp }}</td>
                                        @foreach($empleados as $empleado)
                                            @if(($empleado->id) == ($item->id_empleado))
                                                <td>{{ $empleado->nombre }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ number_format($sumFactIslrMes,2,",",".") }}</td>
                                    </tr>                                    
                                @endif                                    
                            @endforeach
                                <tr class="active">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total mes:</strong></td>
                                    <td><strong>{{ number_format($totalFactIslrMes,2,",",".") }}</strong></td>
                                </tr>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
        <!-- Fin Retenciones ISLR del mes -->

	</div>
@stop