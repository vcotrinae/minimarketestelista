<?php

$item = null;
$valor = null;
$orden = "pro_id";

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);



 ?>


<!-- PRODUCT LIST -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> <strong>Productos recien agregados</strong></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">

        <?php

         // Obtener la cantidad total de productos
         $totalProductos = count($productos);
         // Determinar cuántos productos mostrar (máximo 10)
         $productosAMostrar = min($totalProductos, 10);

        for($i = 0; $i < $productosAMostrar; $i++){
            $item = "cat_id";
            $valor = $productos[$i]["pro_id_categoria"];                                      
            $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor); 
            //var_dump($categoria["cat_categoria"]);
            echo'

            <li class="item">
                <div class="product-img">
                    <img src="'.$productos[$i]["pro_imagen"].'"  alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                    <a href="categorias" class="product-title">'.$categoria["cat_categoria"].'
                        <span class="badge badge-warning float-right">S/. '.$productos[$i]["pro_precio_venta"].'</span></a>
                    <span class="product-description">
                        '.$productos[$i]["pro_descripcion"].'
                    </span>
                </div>
            </li>

            ';
        }

        ?>

        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
        <a href="productos" class="uppercase">Ver todos los productos</a>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->