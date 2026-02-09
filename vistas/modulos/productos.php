<?php
if($_SESSION["usu_perfil"] == "Vendedor"){
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
                    <h1 class="m-0"> Productos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"> Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Administrar Productos</li>
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                                <i class="fa fa-plus" aria-hidden="true"></i> Agregar Producto </button>
                        </div>
                        <div class="card-body">
                            <table id="tablaProductosAjax" class="table table-bordered table-striped tablaProductos ">
                                <thead>
                                    <tr>
                                        <th style="width:10px">#</th>
                                        <th>Imagen</th>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Categoría</th>
                                        <th>Proveedor</th>
                                        <th style="width:50px">Stock</th>
                                        <th>Precio de compra</th>
                                        <th>Precio de venta</th>
                                        <th>Agregado</th>
                                        <th>Ajustes</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                             /*              $item = null;
                                            $valor = null;
                                            $productos = ControladorProductos::ctrMostrarProductos($item, $valor);
                                         //   var_dump($productos);

                                            foreach ($productos as $key => $value) {
          
                                                echo '<tr>
                                                        <td>'.($key+1).'</td>
                                                        <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                                                        <td>'.$value["pro_codigo"].'</td>
                                                        <td>'.$value["pro_descripcion"].'</td>';
                                      
                                                        $item = "cat_id";
                                                        $valor = $value["pro_id_categoria"];                                      
                                                        $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);                                      
                                                       echo '<td>'.$categoria["cat_categoria"].'</td>';

                                                       $item = "prove_id";
                                                       $valor = $value["pro_id_proveedor"];                                      
                                                       $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);  
                                                       echo'<td>'.$proveedor["prove_razon_social"].'</td>';

                                                       echo'<td>'.$value["pro_stock"].'</td>
                                                        <td>'.$value["pro_precio_compra"].'</td>
                                                        <td>'.$value["pro_precio_venta"].'</td>
                                                        <td>'.$value["pro_fecha_create"].'</td>
                                                        <td>
                                      
                                                          <div class="btn-group">                                                              
                                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i>Editar</button>                                      
                                                            <button class="btn btn-danger"><i class="fa fa-times"></i>Eliminar</button>                                      
                                                          </div>  
                                      
                                                        </td>
                                      
                                                      </tr>';
                                      
                                              }
                                            
                                            
                                            */
                                            ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:10px">#</th>
                                        <th>Imagen</th>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Categoría</th>
                                        <th>Proveedor</th>
                                        <th>Stock</th>
                                        <th>Precio de compra</th>
                                        <th>Precio de venta</th>
                                        <th>Agregado</th>
                                        <th>Ajustes</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" value="<?php echo $_SESSION['usu_perfil'] ?>" id="perfilOculto">
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
MODAL AGREGAR PRODUCTOS
======================================-->
<div class="modal fade" id="modalAgregarProducto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Productos </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-th"></i>
                            </span>
                        </div>
                        <select class="form-control select2" id="nuevaCategoria" name="nuevaCategoria" style="width: 90%;" required>
                            <option value="">Seleccione categoría...</option>
                            <?php
                            $item = null;
                            $valor = null;                                      
                            $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor); 
                            //var_dump($categoria);
                            foreach ($categoria as $key => $value) {
                                echo '<option value="'.$value["cat_id"].'">'.$value["cat_categoria"].'</option>';
                             }  
                            ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-code"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" readonly id="nuevoCodigo" name="nuevoCodigo"
                            placeholder="Ingresar código" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-product-hunt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="nuevaDescripcion"
                            placeholder="Ingresar descripción" required>
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </span>
                        </div>
                        <select class="form-control select2" name="nuevoProveedor" style="width: 90%;" required>
                            <option value="">Seleccione proveedor...</option>
                            <?php
                             $item = null;
                             $valor = null;                                      
                             $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor); 
                             foreach ($proveedor as $key => $value) {
                                echo '<option value="'.$value["prove_id"].'">'.$value["prove_razon_social"].'</option>';
                             }   
                            ?>

                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock"
                            required>
                    </div>

                    <div class="d-flex mb-3">

                        <div class="input-group me-2">
                            <!-- Agregamos un margen a la derecha -->
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-arrow-up"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" 
                                placeholder="Precio de compra" required>

                        </div>

                        <div class="input-group">
                            <!-- Sin margen derecho aquí -->
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-arrow-down"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>    
                        </div>
                    </div>

                    <div class="d-flex mb-3">

                        <div class="input-group me-2">
                            <!-- Agregamos un margen a la derecha -->
                        </div>

                        <div class="input-group">
                            <label>                                
                                <input type="checkbox" class="minimal porcentaje" checked>
                                Utilizar procentaje
                            </label>

                        </div>

                        <div class="input-group">
                            <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40"
                                required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-percent"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <div class="form-group">
                            <div class="panel">SUBIR IMAGEN</div>
                            <input type="file" class="nuevaImagen" name="nuevaImagen">
                            <p class="help-block">Peso máximo de la foto 2 MB</p>
                            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                        </div>
                    </div>



                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                </div>

            <?php
            $crearProducto = new ControladorProductos();
            $crearProducto -> ctrCrearProducto();
            ?>

            </form>          

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--=====================================
MODAL EDITAR PRODUCTOS
======================================-->
<div class="modal fade" id="modalEditarProducto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Producto </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-th"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" id="editarCategoriaName"  readonly required>                       
                        <input type="hidden" class="form-control input-lg" id="editarCategoria" name="editarCategoria" readonly required>                       
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-code"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-product-hunt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </span>
                        </div>
                        <select class="form-control select2" id="editarProveedor" name="editarProveedor" style="width: 90%;" required>
                            <option value="">Actualizar proveedor...</option>
                            <?php
                             $item = null;
                             $valor = null;                                      
                             $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor); 
                             foreach ($proveedor as $key => $value) {
                                echo '<option value="'.$value["prove_id"].'">'.$value["prove_razon_social"].'</option>';
                             }   
                            ?>

                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-check"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0"  required>
                    </div>

                    <div class="d-flex mb-3">

                        <div class="input-group me-2">
                            <!-- Agregamos un margen a la derecha -->
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-arrow-up"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>

                        </div>

                        <div class="input-group">
                            <!-- Sin margen derecho aquí -->
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-arrow-down"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" readonly required>    
                        </div>
                    </div>

                    <div class="d-flex mb-3">

                        <div class="input-group me-2">
                            <!-- Agregamos un margen a la derecha -->
                        </div>

                        <div class="input-group">
                            <label>                                
                                <input type="checkbox" class="minimal porcentaje" checked>
                                Utilizar procentaje
                            </label>

                        </div>

                        <div class="input-group">
                            <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40"
                                required>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-percent"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="input-group mb-3">
                        <div class="form-group">
                            <div class="panel">SUBIR IMAGEN</div>
                            <input type="file" class="nuevaImagen" name="editarImagen">
                            <p class="help-block">Peso máximo de la foto 2 MB</p>
                            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                            <input type="hidden" name="imagenActual" id="imagenActual">
                        </div>
                    </div>



                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Actualizar</button>
                </div>

            <?php
            $editarProducto = new ControladorProductos();
            $editarProducto -> ctrEditarProducto();
            ?>

            </form>          

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto -> ctrEliminarProducto();

?>      
