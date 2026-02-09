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
                    <h1 class="m-0"> Proveedores</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"> Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Administrar Proveedores</li>
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
                                <i class="fa fa-plus" aria-hidden="true"></i> Agregar proveedor </button>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped tablas">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>RUC</th>
                                        <th>Razón Social</th>
                                        <th>Nombre Comercial</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Direción</th>
                                        <th>Fecha Creación</th>
                                        <th>Ajustes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                            $item = null;
                                            $valor = null;
                                            $estudiantes = ControladorProveedores::ctrMostrarProveedores($item, $valor);
                                            
                                            foreach ($estudiantes as $key => $value) {
                                                echo '
                                                <tr>
                                                <td>'.($key+1).'</td>
                                                <td>'.$value["prove_ruc"].'</td>
                                                <td>'.$value["prove_razon_social"].'</td>
                                                <td>'.$value["prove_nombre_comercial"].'</td>
                                                <td>'.$value["prove_email"].'</td>
                                                <td>'.$value["prove_telefono"].'</td>
                                                <td>'.$value["prove_direccion"].'</td>
                                                <td>'.$value["prove_fecha_create"].'</td> 
                                                <td>
                                                <div class="btn-group">                          
                                                    <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$value["prove_id"].'" data-toggle="modal" data-target="#modalEditarProveedor"> <i class="fa fa-pencil"></i> </button>';
                                                if($_SESSION["usu_perfil"] == "Administrador"){ 
                                                        echo '
                                                    <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$value["prove_id"].'"> <i class="fa fa-trash-o" aria-hidden="true"></i>  </button>';
                                             }
                                                echo'
                                                </div>  
                                                </td>
                                            </tr>
                                                ';

                                            }
                                            ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>RUC</th>
                                        <th>Razón Social</th>
                                        <th>Nombre Comercial</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Direción</th>
                                        <th>Fecha Creación</th>
                                        <th>Ajustes</th>
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
MODAL AGREGAR ESTUDIANTES
======================================-->
<div class="modal fade" id="modalAgregarProveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="nuevoRuc" placeholder="Ingrese RUC" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="nuevoRazonSocial"
                            placeholder="Ingrese Razon Social" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="nuevoNombreComercial"
                            placeholder="Ingrese NombreComercial" required>
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
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="nuevoDireccion" placeholder="Ingrese Direccion"
                            required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                </div>

                <?php
            $crearProveedor = new ControladorProveedores();
            $crearProveedor -> ctrCrearProveedor();
            ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--=====================================
MODAL EDITAR ESTUDIANTES
======================================-->
<div class="modal fade" id="modalEditarProveedor">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Proveedor</h4>
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
                        <input type="text" class="form-control input-lg" name="editarRuc" id="editarRuc"
                            required>
                        <input type="hidden" id="idProveedor" name="idProveedor">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="editarRazonSocial" id="editarRazonSocial">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="editarNombreComercial" id="editarNombreComercial">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                                <i class="fa fa-envelope" aria-hidden="true"></i> 
                            </span>
                        </div>
                        <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="editarTelefono" id="editarTelefono"
                            placeholder="Ingrese Telefono" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" name="editarDireccion" id="editarDireccion"
                            placeholder="Ingrese Direccion" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                </div>

                <?php
            $editarProveedor = new ControladorProveedores();
            $editarProveedor -> ctrEditarProveedor();
        ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php

  $borrarProveedor = new ControladorProveedores();
  $borrarProveedor -> ctrBorrarProveedor();

?>