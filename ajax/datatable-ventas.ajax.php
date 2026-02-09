<?php

require_once __DIR__ . "/../controladores/categorias.controlador.php";
require_once __DIR__ . "/../controladores/productos.controlador.php";
require_once __DIR__ . "/../controladores/proveedores.controlador.php";

require_once __DIR__ . "/../modelos/categorias.modelo.php";
require_once __DIR__ . "/../modelos/productos.modelo.php";
require_once __DIR__ . "/../modelos/proveedores.modelo.php";

class TablaVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaVentas(){

		$item = null;
    	$valor = null;
    	$orden = "pro_id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);	

		//var_dump($productos);

		$datosJSON =  '{
			"data":[';

			for ($i=0; $i < count($productos); $i++) { 				
			
				$imagen = "<img src='".$productos[$i]["pro_imagen"]."' width='40px'>";

			
					if($productos[$i]["pro_stock"] < 10){
						$stock = "<button class='btn btn-danger'>0".$productos[$i]["pro_stock"]." <i class='fa fa-exclamation-circle' aria-hidden='true'></i> </button>";
					}else if($productos[$i]["pro_stock"] >= 10 && $productos[$i]["pro_stock"] <= 15){
						$stock = "<button class='btn btn-warning'>".$productos[$i]["pro_stock"]." <i class='fa fa-exclamation-triangle' aria-hidden='true'></i> </button>";
					}else{
						$stock = "<button class='btn btn-success'>".$productos[$i]["pro_stock"]." <i class='fa fa-check-square-o' aria-hidden='true'></i> </button>";
					}

                    $botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["pro_id"]."'>Agregar</button></div>"; 

								
				
				$datosJSON .='[
					"'.($i+1).'",
					"'.$imagen.'",
					"'.$productos[$i]["pro_codigo"].'",
			      	"'.$productos[$i]["pro_descripcion"].'", 
					"'.$stock.'", 		
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
$activarVentas = new TablaVentas();
$activarVentas -> mostrarTablaVentas();