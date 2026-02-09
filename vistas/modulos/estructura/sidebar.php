<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
        <img src="vistas/img/plantilla/icono-blanco.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            ESTELISTA
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php 
                if ($_SESSION["usu_foto"] != "") {
                    echo '<img src="'.$_SESSION["usu_foto"].'" class="img-circle elevation-2">';
                } else{
                    echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle elevation-2">';
                }
            ?>


            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["usu_nombre"] ;?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
            <?php 
            if($_SESSION["usu_perfil"] =="Administrador"){

                echo '
                <li class="nav-item">
                    <a href="inicio" class="nav-link active">
                        <i class="fa fa-home nav-icon"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="usuarios" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                ';
            }

            if($_SESSION["usu_perfil"] == "Administrador" || $_SESSION["usu_perfil"] == "Especial"){

                echo '
                <li class="nav-item">
                    <a href="proveedores" class="nav-link">
                        <i class="fa fa-th nav-icon"></i>
                        <p>Proveedores</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="categorias" class="nav-link">
                        <i class="fa fa-th nav-icon"></i>
                        <p>Categorías</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="productos" class="nav-link">
                        <i class="fa fa-th nav-icon"></i>
                        <p>Productos</p>
                    </a>
                </li>                

                ';

            }

            if($_SESSION["usu_perfil"] == "Administrador" || $_SESSION["usu_perfil"] == "Vendedor"){
                echo '
                <li class="nav-item">
                    <a href="clientes" class="nav-link">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Clientes</p>
                    </a>
                </li>

                ';

            }

            if($_SESSION["usu_perfil"] == "Administrador" || $_SESSION["usu_perfil"] == "Vendedor"){
                echo '

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="ventas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar ventas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crear-venta" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear venta</p>
                            </a>
                        </li>';
                if($_SESSION["usu_perfil"] == "Administrador"){
                echo'   <li class="nav-item">
                            <a href="reportes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reporte de ventas</p>
                            </a>
                        </li>';}
                echo '        
                    </ul>
                </li>
                ';
            }
                      
            ?>              

            </ul>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- MENU  
<li class="nav-item">
                    <a href="inicio" class="nav-link active">
                        <i class="fa fa-home nav-icon"></i>
                        <p>Inicio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="usuarios" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>Usuarios</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="proveedores" class="nav-link">
                        <i class="fa fa-th nav-icon"></i>
                        <p>Proveedores</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="categorias" class="nav-link">
                        <i class="fa fa-th nav-icon"></i>
                        <p>Categorías</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="productos" class="nav-link">
                        <i class="fa fa-th nav-icon"></i>
                        <p>Productos</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="clientes" class="nav-link">
                        <i class="fa fa-users nav-icon"></i>
                        <p>Clientes</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="ventas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar ventas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="crear-venta" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear venta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="reportes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reporte de ventas</p>
                            </a>
                        </li>
                    </ul>
                </li>

                -->