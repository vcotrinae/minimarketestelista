
<?php

$item = null;
$valor = null;
$orden = "pro_id";

$ventas = ControladorVentas::ctrSumaTotalVentas();

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>


<!-- Small boxes (Stat box) -->
<div class="row">

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3>S/. 
                <?php 
                $totalVentas = $ventas["total"] ?? 0; // Asignar 0 si es null
                echo number_format($totalVentas, 2)
                 ?> </h3>

            <p>Ventas</p>
        </div>
        <div class="icon">
            <i class="ion-cash"></i>
        </div>
        <a href="ventas" class="small-box-footer">Más información <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo number_format($totalCategorias); ?></h3>

            <p>Categorías</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="categorias" class="small-box-footer"> Más información <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo number_format($totalClientes); ?></h3>

            <p>Cliente</p>
        </div>
        <div class="icon">
            <i class="ion-person-stalker"></i>
        </div>
        <a href="clientes" class="small-box-footer"> Más información <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo number_format($totalProductos); ?></h3>

            <p> Productos</p>
        </div>
        <div class="icon">
            <i class="ion-pricetags"></i>
        </div>
        <a href="productos" class="small-box-footer"> Más información <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
</div>