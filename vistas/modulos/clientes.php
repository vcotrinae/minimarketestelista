
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
                    <h1 class="m-0"> Clientes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"> Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Administrar Clientes</li>
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
                            <i class="fa fa-plus" aria-hidden="true"></i>  Agregar Cliente </button>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped tablas">
                                <thead>
                                    <tr>
                                    <th style="width:10px">#</th>
                                    <th>Nombre</th>
                                    <th>Documento ID</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Fecha nacimiento</th> 
                                    <th>Total compras</th>
                                    <th>Última compra</th>
                                    <th>Ingreso al sistema</th>
                                    <th>Ajustes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                            $item = null;
                                            $valor = null;
                                            $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                                            
                                            foreach ($cliente as $key => $value) {
                                                echo '
                                                <tr>
                                                <td>'.($key+1).'</td>
                                                <td>'.$value["cli_nombre"].'</td>                                                
                                                <td>'.$value["cli_documento"].'</td>                                                
                                                <td>'.$value["cli_email"].'</td>                                                
                                                <td>'.$value["cli_telefono"].'</td>                                                
                                                <td>'.$value["cli_direccion"].'</td>                                                
                                                <td>'.$value["cli_fecha_nacimiento"].'</td>                                                
                                                <td>'.$value["cli_compras"].'</td>                                              
                                                <td>'.$value["cli_ultima_compra"].'</td>                                                
                                                <td>'.$value["cli_fecha_create"].'</td>                                                
                                                <td>
                                                <div class="btn-group">                          
                                                    <button class="btn btn-warning btnEditarCliente" idCliente="'.$value["cli_id"].'" data-toggle="modal" data-target="#modalEditarCliente"> <i class="fa fa-pencil"></i> Editar</button>';
                                            if($_SESSION["usu_perfil"] == "Administrador"){        
                                            echo '     
                                            <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["cli_id"].'"> <i class="fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>';
                                            }
                                        echo'     </div>  
                                                </td>
                                            </tr>
                                                ';

                                            }
                                            ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:10px">#</th>
                                        <th>Nombre</th>
                                        <th>Documento ID</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Fecha nacimiento</th> 
                                        <th>Total compras</th>
                                        <th>Última compra</th>
                                        <th>Ingreso al sistema</th>
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
                        <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>
                    </div>

                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                        <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>
                    </div>

                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                                <i class="fa fa-envelope" aria-hidden="true"></i> 
                            </span>
                        </div>
                        <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                        <i class="fas fa-phone"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(99) 999-999-999'" data-mask required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                        <i class="fa fa-map-marker"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>
                    </div>

                    <div class="input-group mb-3">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">                        
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" name="nuevaFechaNacimiento"  placeholder="Ingresar fecha nacimiento" data-target="#reservationdate"/>
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


<!--=====================================
MODAL EDITAR CLientes
======================================-->
<div class="modal fade" id="modalEditarCliente">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Cliente</h4>
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
                        <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                        <input type="hidden" id="idCliente" name="idCliente">
                    </div>

                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                        <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" required>
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
                        <span class="input-group-text"> 
                        <i class="fas fa-phone"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(99) 999-999-999'" data-mask required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                        <i class="fa fa-map-marker"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion"  required>
                    </div>

                    <div class="input-group mb-3">
                    <div class="input-group date" id="editarFNacimiento" data-target-input="nearest">                        
                        <div class="input-group-append" data-target="#editarFNacimiento" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" name="editarFechaNacimiento" id="editarFechaNacimiento"   data-target="#editarFNacimiento"/>
                    </div>

                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                </div>

                <?php
            $editarCliente = new ControladorClientes();
            $editarCliente -> ctrEditarCliente();
            ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>
