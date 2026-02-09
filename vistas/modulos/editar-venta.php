<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Generar Venta</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"> Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Generar Venta </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header"> </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" class="formularioVenta">

                            <div class="card-body">
                            <?php
                                  $item = "ven_id";
                                  $valor = $_GET["idVenta"];
                                  $venta = ControladorVentas::ctrMostrarVentas($item, $valor);
                                  //var_dump($ventas);
                                  //TRAENMOS VENDEDOR
                                  $itemUsuario = "usu_id";
                                  $valorUsuario = $venta["ven_id_vendedor"];
                                  $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                                //  var_dump($vendedor);

                                  //TRAENMOS CLIENTE
                                  $itemCliente = "cli_id";
                                  $valorCliente = $venta["ven_id_cliente"];              
                                  $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                                 // var_dump($cliente)
                                
                                 $porcentajeImpuesto = $venta["ven_impuesto"] * 100 / $venta["ven_neto"];
                            ?>

                                <!--=====================================
                            ENTRADA DEL VENDEDOR
                            ======================================-->

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["usu_nombre"]; ?>" readonly>

                                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["usu_id"]; ?>">
                                </div>

                                <!--=====================================
                                ENTRADA DEL CÓDIGO
                                ======================================-->

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-key"></i>
                                        </span>
                                    </div>                                                                                           
                                    <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["ven_codigo"]; ?>"readonly>                                    
                                </div>

                                <!--=====================================
                                ENTRADA DEL CLIENTE
                                ======================================-->

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-10">
                                        <div class="input-group">
                                            <select class="form-control select2" id="seleccionarCliente" name="seleccionarCliente" required>
                                            <option value="<?php echo $cliente["cli_id"]; ?>"><?php echo $cliente["cli_nombre"]; ?></option>
                                                <?php
                                                $item = null;
                                                $valor = null;                                      
                                                $cliente = ControladorClientes::ctrMostrarClientes($item, $valor); 
                                                foreach ($cliente as $key => $value) {
                                                    echo '<option value="'.$value["cli_id"].'">'.$value["cli_nombre"].'</option>';
                                                }   
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-2">
                                        <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#modalAgregarCliente" data-dismiss="modal">Agregar
                                        </button>
                                    </div>
                                </div>
                                <br>


                                <!--=====================================
                                ENTRADA DE LOS PRODUCTOS
                                ======================================-->

                                <div>

                                    <div class="row">
                                        <div class="col-12 nuevoProducto">
                                        <?php

                                        $listaProducto = json_decode($venta["ven_productos"], true); 
                                        //var_dump($listaProducto);
                                        foreach ($listaProducto as $key => $value) {

                                            $item = "pro_id";
                                            $valor = $value["json_pro_id"];
                                            $orden = "pro_id";

                                            $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                                            $stockAntiguo = $respuesta["pro_stock"] + $value["json_pro_cantidad"];


                                            echo '
                                             <div class="row ">
                                                <div class="col-7">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-danger quitarProducto" idProducto="'.$value["json_pro_id"].'"> <i class="fa fa-times"></i></button>
                                                        </div>
                                                        <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["json_pro_id"].'" id="agregarProducto" name="agregarProducto" value="'.$value["json_pro_descripcion"].'" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-2 ">
                                                    <input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["json_pro_cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["json_pro_stock"].'" required>
                                                </div>
                                                <div class="col-3 ingresoPrecio">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <strong> S/.</strong>
                                                            </span>
                                                        </div>
                                                        <input type="text" min="1" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["pro_precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["json_pro_total"].'" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            ';
                                        }

                                        ?>
                                            <!--     <div class="row ">
                                                <div class="col-7">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <button type="button" class="btn btn-danger "><i
                                                                    class="fa fa-times"></i></button>
                                                        </div>
                                                        <input type="text" class="form-control" id="agregarProducto"
                                                            name="agregarProducto"
                                                            placeholder="Descripción del producto" required>
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <input type="number" class="form-control" id="nuevaCantidadProducto"
                                                        name="nuevaCantidadProducto" min="1" placeholder="0" required>
                                                </div>

                                                <div class="col-3">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <strong> S/.</strong>
                                                            </span>
                                                        </div>
                                                        <input type="number" min="1" class="form-control"
                                                            id="nuevoPrecioProducto" name="nuevoPrecioProducto"
                                                            placeholder="000000" readonly required>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            -->


                                        </div>

                                    </div>

                                </div>

                                <input type="hidden" id="listaProductos" name="listaProductos">

                                <!--=====================================
                                BOTONPARA MOVILES
                                ======================================-->
                                <button type="button"
                                    class="btn btn-default d-block d-sm-none btnAgregarProducto">Agregar
                                    producto</button>

                                <hr>

                                <div class="d-flex mb-3">

                                    <div class="input-group" style="padding-right:0px; flex: 2;">
                                        <!-- Aumentar el flex a 3 -->
                                    </div>

                                    <div class="input-group" style="flex: 3;">
                                        <!-- Mantener flex en 1 -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" min="0"
                                                                id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>

                                                            <input type="hidden" name="nuevoPrecioImpuesto"  id="nuevoPrecioImpuesto" value="<?php echo $venta["ven_impuesto"]; ?>" required>

                                                            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["ven_neto"]; ?>" required>

                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-percent"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td style="width: 50%">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <strong> S/.</strong>
                                                                </span>
                                                            </div>
                                                            <input type="text" min="1" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["ven_neto"]; ?>" value="<?php echo $venta["ven_total"]; ?>" readonly required>
                                                            <input type="hidden" name="totalVenta" value="<?php echo $venta["ven_total"]; ?>" id="totalVenta">

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-6">

                                        <label for="Medio de pago">Método de pago</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago"
                                                required>
                                                <option value="">Seleccione método de pago</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="T-C">Tarjeta Crédito</option>
                                                <option value="T-D">Tarjeta Débito</option>
                                            </select>
                                        </div>

                                    </div>

                                    <!-- AQUI VA TRANSACCION -->
                                    <div class="col-6 metodoPagoTransaccion">

                                    </div>
                                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Guardar cambios</button>
                            </div>

                        </form>
                        
                        <?php

                        $editarVenta = new ControladorVentas();
                        $editarVenta -> ctrEditarVenta();

                        ?>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->


                <!-- right column -->
                <div class="col-md-6 d-none d-md-block">

                    <div class="card card-primary">

                        <div class="card-header"> </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">

                                    <table id="tablaVentasProductosAjax"
                                        class="table table-bordered table-striped tablaVentas">
                                        <thead>
                                            <tr>
                                                <th style="width:10px">#</th>
                                                <th>Imagen</th>
                                                <th>Código</th>
                                                <th>Descripcion</th>
                                                <th>Stock</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>



                                        <tfoot>
                                            <tr>
                                                <th style="width:10px">#</th>
                                                <th>Imagen</th>
                                                <th>Código</th>
                                                <th>Descripcion</th>
                                                <th>Stock</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->



                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>




<!--=====================================
MODAL AGREGAR CLientes
======================================-->
<div class="modal fade" id="modalAgregarCliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="nuevoCliente"
                            placeholder="Ingresar nombre" required>
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <input type="text" min="0" class="form-control input-lg" name="nuevoDocumentoId"
                            placeholder="Ingresar documento" required>
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email"
                            required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-phone"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="nuevoTelefono"
                            placeholder="Ingresar teléfono" data-inputmask="'mask':'(99) 999-999-999'" data-mask
                            required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="nuevaDireccion"
                            placeholder="Ingresar dirección" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control datetimepicker-input" name="nuevaFechaNacimiento"
                                placeholder="Ingresar fecha nacimiento" data-target="#reservationdate" />
                        </div>

                    </div>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                </div>

                <?php
            $crearCliente = new ControladorClientes();
            $crearCliente -> ctrCrearCliente();
            ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->