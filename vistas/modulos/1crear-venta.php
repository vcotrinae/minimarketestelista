<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Categorías</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"> Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Administrar Categorías</li>
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
                <div class="col-lg-5 col-xs-12">

                    <form form="" method="post">
                        <div class="card card-primary card-outline">

                            <div class="card-header"> </div>

                            <div class="card-body">

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                                        value="Usuario Administrador" readonly>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-key"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta"
                                        value="10002343" readonly>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control select2" id="seleccionarCliente"
                                        name="seleccionarCliente" required>
                                        <option value="">Seleccionar clientes...</option>
                                        <?php
                                        $item = null;
                                        $valor = null;                                      
                                        $cliente = ControladorClientes::ctrMostrarClientes($item, $valor); 
                                        foreach ($cliente as $key => $value) {
                                            echo '<option value="'.$value["cli_id"].'">'.$value["cli_nombre"].'</option>';
                                        }   
                                        ?>
                                    </select>

                                    <button type="button" class="btn btn-default btn-xs" data-toggle="modal"
                                        data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button>
                                </div>



                                <div class="d-flex mb-3 nuevoProducto">

                                    <div class="input-group" style="padding-right:0px; flex: 2.5;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <button type="button" class="btn btn-danger btn-xs"><i
                                                        class="fa fa-times"></i></button>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="agregarProducto"
                                            name="agregarProducto" placeholder="Descripción del producto" required>
                                    </div>

                                    <div style="width: 10px;"></div> <!-- Espaciador -->

                                    <div class="input-group" style="flex: 1;">
                                        <input type="number" class="form-control" id="nuevaCantidadProducto"
                                            name="nuevaCantidadProducto" min="1" placeholder="0" required>
                                    </div>

                                    <div style="width: 10px;"></div> <!-- Espaciador -->

                                    <div class="input-group" style="flex: 1;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <strong> S/.</strong>
                                            </span>
                                        </div>
                                        <input type="number" min="1" class="form-control" id="nuevoPrecioProducto"
                                            name="nuevoPrecioProducto" placeholder="000000" readonly required>
                                    </div>
                                </div>


                                <button type="button" class="btn btn-default d-block d-sm-none">Agregar
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
                                                            <input type="number" class="form-control" min="0"
                                                                id="nuevoImpuestoVenta" name="nuevoImpuestoVenta"
                                                                placeholder="0" required>
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
                                                            <input type="number" min="1" class="form-control"
                                                                id="nuevoTotalVenta" name="nuevoTotalVenta"
                                                                placeholder="00000" readonly required>

                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <hr>

                                <div class="d-flex mb-3">

                                    <div class="input-group" style="padding-right:0px; flex: 2.5;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <select class="form-control select2" id="nuevoMetodoPago" name="nuevoMetodoPago"
                                            required>
                                            <option value="">Seleccione método de pago</option>
                                            <option value="efectivo">Efectivo</option>
                                            <option value="tarjetaCredito">Tarjeta Crédito</option>
                                            <option value="tarjetaDebito">Tarjeta Débito</option>
                                        </select>
                                    </div>

                                    <div style="width: 10px;"></div> <!-- Espaciador -->

                                    <div class="input-group" style="flex: 2;">
                                        <input type="text" class="form-control" id="nuevoCodigoTransaccion"
                                            name="nuevoCodigoTransaccion" placeholder="Código transacción" required>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>








                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Guardar venta</button>
                            </div>

                        </div>
                    </form>

                    <!-- /.card -->
                </div>

                <div class="col-lg-7 hidden-md hidden-sm, hiddem-xs">

                    <div class="card card-primary card-outline">

                        <div class="card-header"> </div>

                        <div class="card-body">
                            <table id="tablaProductosAjaxx" class="table table-bordered table-striped tablaVentas ">
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

                                <tbody>

                                    <tr>
                                        <td>1.</td>
                                        <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail"
                                                width="40px"></td>
                                        <td>00123</td>
                                        <td>Lorem ipsum dolor sit amet</td>
                                        <td>20</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Agregar</button>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>

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

                    <!-- /.card -->
                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
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
                        <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId"
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






<div class="row">
    <div class="col-3">
        <input type="text" class="form-control" placeholder=".col-3">
    </div>
    <div class="col-4">
        <input type="text" class="form-control" placeholder=".col-4">
    </div>
    <div class="col-5">
        <input type="text" class="form-control" placeholder=".col-5">
    </div>
</div>







<div class="input-group" style="padding-right:0px; flex: 2.5;">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
        </span>
    </div>
    <input type="text" class="form-control" id="agregarProducto" name="agregarProducto"
        placeholder="Descripción del producto" required>
</div>

<div style="width: 10px;"></div> <!-- Espaciador -->


<div class="input-group" style="flex: 1;">
    <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1"
        placeholder="0" required>
</div>

<div style="width: 10px;"></div> <!-- Espaciador -->

<div class="input-group" style="flex: 1;">
    <div class="input-group-prepend">
        <span class="input-group-text">
            <strong> S/.</strong>
        </span>
    </div>
    <input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto"
        placeholder="000000" readonly required>
</div>


<div class="row ">
    <div class="col-7">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button type="button" class="btn btn-danger quitarProducto" idProducto><i
                        class="fa fa-times"></i></button>' +
            </div>
            <select class="form-control nuevaDescripcionProducto " id="producto + numProducto" idProducto
                name="nuevaDescripcionProducto" required>
                <option value="">Seleccione producto</option>
            </select>
        </div>
    </div>
    <div class="col-2 ingresoCantidad">
        <input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1"
            stock nuevoStock required>
    </div>
    <div class="col-3 ingresoPrecio">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <strong> S/.</strong>
                </span>
            </div>
            <input type="text" min="1" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto"
                readonly required>
        </div>
    </div>
</div>


<div class="row ">
    <div class="col-7">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button type="button" class="btn btn-danger quitarProducto" idProducto="' +
            idProducto +
            '"><i class="fa fa-times"></i></button>
            </div>
            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" id="agregarProducto" name="agregarProducto" value="' +descripcion +'" readonly required>
        </div>
    </div>
    <div class="col-2 ">
        <input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="' + stock +'" nuevoStock="' +Number(stock - 1) +'" required>
    </div>
    <div class="col-3 ingresoPrecio">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <strong> S/.</strong>
                </span>
            </div>
            <input type="text" min="1" class="form-control nuevoPrecioProducto" precioReal="' +precio +'"
                name="nuevoPrecioProducto" value="' +precio +'" readonly required>
        </div>
    </div>
</div>