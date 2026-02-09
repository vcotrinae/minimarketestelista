<?php
if($_SESSION["usu_perfil"] == "Especial" || $_SESSION["usu_perfil"] == "Vendedor"){
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
                    <h1 class="m-0"> Reportes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio"> Inicio</a></li>
                        <li class="breadcrumb-item active">Tablero Administrar Reportes</li>
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
                            <button type="button" class="btn btn-default" id="daterange-btn2">
                                <span>
                                    <i class="fa fa-calendar"></i> Rango de fecha
                                </span>
                                <i class="fa fa-caret-down"></i>
                            </button>
                        </div>
                        <div class="card-body">

                            <section class="col-xs-12 connectedSortable">
                                <?php
                                include "reportes/grafico-ventas.php";
                                ?>
                                <!-- /.card -->
                            </section>


                        </div>
                    </div>
                    <!-- /.card -->

                </div>

                <section class="col-lg-6 connectedSortable">
                    <?php
                        include "reportes/productos-mas-vendidos.php";
                    ?>
                    <!-- /.card -->
                </section>

                <section class="col-lg-6 connectedSortable">
                    <?php
                         include "reportes/vendedores.php";
                    ?>
                    
                    <br>            

                    <?php
                        include "reportes/compradores.php";
                    ?>
                    <!-- /.card -->
                </section>
               



            </div>


        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->