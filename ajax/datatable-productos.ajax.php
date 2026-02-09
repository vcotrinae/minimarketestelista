<?php

require_once __DIR__ . "/../controladores/categorias.controlador.php";
require_once __DIR__ . "/../controladores/productos.controlador.php";
require_once __DIR__ . "/../controladores/proveedores.controlador.php";

require_once __DIR__ . "/../modelos/categorias.modelo.php";
require_once __DIR__ . "/../modelos/productos.modelo.php";
require_once __DIR__ . "/../modelos/proveedores.modelo.php";

class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

		$item = null;
    	$valor = null;
    	$orden = "pro_id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	

		//var_dump($productos);

		$datosJSON =  '{
			"data":[';

			for ($i=0; $i < count($productos); $i++) { 				
			
				$imagen = "<img src='".$productos[$i]["pro_imagen"]."' width='40px'>";

				$item = "cat_id"; 
				$valor = $productos[$i]["pro_id_categoria"];                                    
				$categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);                                      
			   		//echo '<td>'.$categoria["cat_categoria"].'</td>';

			    $item = "prove_id";
			    $valor = $productos[$i]["pro_id_proveedor"]; 
			    $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);  
			   		//echo'<td>'.$proveedor["prove_razon_social"].'</td>';
				/**
				 * Control de stock
				 */

					if($productos[$i]["pro_stock"] < 10){
						$stock = "<button class='btn btn-danger'>0".$productos[$i]["pro_stock"]." <i class='fa fa-exclamation-circle' aria-hidden='true'></i> </button>";
					}else if($productos[$i]["pro_stock"] >= 10 && $productos[$i]["pro_stock"] <= 15){
						$stock = "<button class='btn btn-warning'>".$productos[$i]["pro_stock"]." <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> </button>";
					}else{
						$stock = "<button class='btn btn-success'>".$productos[$i]["pro_stock"]." <i class='fa fa-check-square-o' aria-hidden='true'></i> </button>";
					}

					if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){
						$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["pro_id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i>Editar</button> </div>"; 
					}else{
						$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["pro_id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i>Editar</button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["pro_id"]."' codigo='".$productos[$i]["pro_codigo"]."' imagen='".$productos[$i]["pro_imagen"]."'><i class='fa fa-times'></i>Eliminar</button></div>"; 
					}
			
					

				$datosJSON .='[
					"'.($i+1).'",
					"'.$imagen.'",
					"'.$productos[$i]["pro_codigo"].'",
			      	"'.$productos[$i]["pro_descripcion"].'",
					"'.$categoria["cat_categoria"].'",
					"'.$proveedor["prove_razon_social"].'",
					"'.$stock.'",
					"'.$productos[$i]["pro_precio_compra"].'",
					"'.$productos[$i]["pro_precio_venta"].'",
					"'.$productos[$i]["pro_fecha_create"].'",		
					"'.$botones.'"		
					],';
			}
		$datosJSON = substr($datosJSON, 0, -1);
		$datosJSON .=']
			}' ; 

		echo $datosJSON ;

		return;


	  	
        
    }

} 

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();