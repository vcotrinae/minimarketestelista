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
                <div class="col-lg-12">

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
                            <i class="fa fa-plus" aria-hidden="true"></i>  Agregar Categoria </button>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped tablas">
                                <thead>
                                    <tr>
                                    <th style="width:10px">#</th>
                                        <th>Categoría</th>                                       
                                        <th>Ajustes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                            $item = null;
                                            $valor = null;
                                            $Categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                                            
                                            foreach ($Categorias as $key => $value) {
                                                echo '
                                                <tr>
                                                <td>'.($key+1).'</td>
                                                <td>'.$value["cat_categoria"].'</td>                                                
                                                <td>
                                                <div class="btn-group">                          
                                                    <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["cat_id"].'" data-toggle="modal" data-target="#modalEditarCategoria"> <i class="fa fa-pencil"></i> Editar</button>';
                                                if($_SESSION["usu_perfil"] == "Administrador"){ 
                                                        echo '
                                                    <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["cat_id"].'"> <i class="fa fa-trash-o" aria-hidden="true"></i>  Eliminar</button>';
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
                                        <th style="width:10px">#</th>
                                        <th>Categoría</th>                                       
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
MODAL AGREGAR CategoriaS
======================================-->
<div class="modal fade" id="modalAgregarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Categorias</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                                <i class="fa fa-id-card" aria-hidden="true"></i> 
                            </span>
                        </div>
                        <input type="text" class="form-control" name="nuevoCategoria" placeholder="Ingrese Categoría"
                            required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                </div>

                <?php
            $crearEstuadiante = new ControladorCategorias();
            $crearEstuadiante -> ctrCrearCategorias();
            ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!--=====================================
MODAL EDITAR CategoriaS
======================================-->
<div class="modal fade" id="modalEditarCategoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Categoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <input type="hidden" class="form-control" name="editarId" id="editarId">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"> 
                                <i class="fa fa-id-card" aria-hidden="true"></i> 
                            </span>
                        </div>
                        <input type="text" class="form-control" name="editarCategoria" id="editarCategoria">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary"> Guardar</button>
                </div>

                <?php
            $editarCategoria = new ControladorCategorias();
            $editarCategoria -> ctrEditarCategoria();
        ?>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>