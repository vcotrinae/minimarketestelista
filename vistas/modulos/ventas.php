<?php
if($_SESSION["usu_perfil"] == "Especial"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Ventas </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"> Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Administrar Ventas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <a href="crear-venta">
                                <button class="btn btn-primary">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Agreagr Venta
                                </button>
                            </a>

                            
                            <button type="button" class="btn btn-default pull-right" id="daterange-btn">           
                            <span>
                                <i class="fa fa-calendar"></i> Rango de fecha
                            </span>
                            <i class="fa fa-caret-down"></i>
                            </button>

                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped tablas">
                                <thead>
                                    <tr>
                                        <th style="width:10px">#</th>
                                        <th>Código factura</th>
                                        <th>Cliente</th>
                                        <th>Vendedor</th>
                                        <th>Forma de pago</th>
                                        <th>Neto</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                        <th>Ajustes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        if(isset($_GET["fechaInicial"])){

                                            $fechaInicial = $_GET["fechaInicial"];
                                            $fechaFinal = $_GET["fechaFinal"];

                                        }else{

                                            $fechaInicial = null;
                                            $fechaFinal = null;

                                        }

                                        $venta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
                                       // var_dump($venta);


                                            //$item = null;
                                            //$valor = null;
                                            //$venta = ControladorVentas::ctrMostrarVentas($item, $valor);
                                            
                                            foreach ($venta as $key => $value) {
                                                echo '
                                                <tr>
                                                <td>'.($key+1).'</td>
                                                <td>'.$value["ven_codigo"].'</  td>';

                                                $itemCliente= "cli_id";
                                                $valorCliente = $value["ven_id_cliente"];
                                                $rptaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                                        echo'   <td>'.$rptaCliente["cli_nombre"].'</td>';

                                                $itemUsuario= "usu_id";
                                                $valorUsuario = $value["ven_id_vendedor"];
                                                $rptaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                                        echo'   <td>'.$rptaUsuario["usu_nombre"].'</td>                                                            
                                        
                                                <td>'.$value["ven_metodo_pago"].'</td>                                                
                                                <td>'.$value["ven_neto"].'</td>                                                
                                                <td>'.$value["ven_total"].'</td>                                                  
                                                <td>'.$value["ven_fecha_create"].'</td>                                                
                                                <td>
                                                <div class="btn-group">                          
                                                    <button class="btn btn-primary btnImprimirFactura" codigoVenta="'.$value["ven_id"].'" > <i class="fa fa-print"></i> </button>';
                                                    if($_SESSION["usu_perfil"] == "Administrador"){ 
                                                        echo '
                                                     <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["ven_id"].'" > <i class="fa fa-pencil"></i> </button>
                                                    <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["ven_id"].'"> <i class="fa fa-trash-o" aria-hidden="true"></i>  </button>
                                                        ';
                                                    }
                                        echo '
                                                </div>  
                                                </td>
                                            </tr>
                                                ';

                                            }
                                            ?>
                                </tbody>
                                <a  target="_blank" rel="noopener noreferrer"></a>
                                <tfoot>
                                    <tr>
                                        <th style="width:10px">#</th>
                                        <th>Código factura</th>
                                        <th>Cliente</th>
                                        <th>Vendedor</th>
                                        <th>Forma de pago</th>
                                        <th>Neto</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                        <th>Ajustes</th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                    <?php

                    $eliminarVenta = new ControladorVentas();
                    $eliminarVenta -> ctrEliminarVenta();

                    ?>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>