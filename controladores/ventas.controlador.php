<?php

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){
		$tabla = "ventas";
		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
		return $respuesta;
	}


	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){
			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			$listaProductos = json_decode($_POST["listaProductos"], true);

			//var_dump($listaProductos);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["json_pro_cantidad"]);

				$tablaProductos = "productos";

			    $item = "pro_id";
			    $valor = $value["json_pro_id"];
				$orden = "pro_id";
			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);

				//var_dump($traerProducto["pro_ventas"]);

				$item1a = "pro_ventas";
				$valor1a = $value["json_pro_cantidad"] + $traerProducto["pro_ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "pro_stock";
				$valor1b = $value["json_pro_stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			} 

			/**
			 * Traemos clientes
			 */
			 
			$tablaClientes = "clientes";

			$item = "cli_id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);
			//var_dump($traerCliente);

			$item1a = "cli_compras";
			//var_dump($totalProductosComprados);
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["cli_compras"];
			var_dump($valor1a);
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);
			

			$item1b = "cli_ultima_compra";
			date_default_timezone_set('America/Lima');
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor); 

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";

			$datos = array("ven_id_vendedor"=>$_POST["idVendedor"],
						   "ven_id_cliente"=>$_POST["seleccionarCliente"],
						   "ven_codigo"=>$_POST["nuevaVenta"],
						   "ven_productos"=>$_POST["listaProductos"],
						   "ven_impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "ven_neto"=>$_POST["nuevoPrecioNeto"],
						   "ven_total"=>$_POST["totalVenta"],
						   "ven_metodo_pago"=>$_POST["listaMetodoPago"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {
								window.location = "ventas";
								}
							})
				</script>';
			}

		}

	}///Fin ctrCrearVenta

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "ven_codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			VALIDAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/
			
			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["ven_productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

					$productos =  json_decode($traerVenta["ven_productos"], true);
					//var_dump($productos);

					$totalProductosComprados = array();

					foreach ($productos as $key => $value) {

						array_push($totalProductosComprados, $value["json_pro_cantidad"]);

						$tablaProductos = "productos";

						$item = "pro_id";
						$valor = $value["json_pro_id"];
						$orden = "pro_id";
						$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);

						$item1a = "pro_ventas";
						$valor1a = $traerProducto["pro_ventas"] - $value["json_pro_cantidad"];
						$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

						$item1b = "pro_stock";
						$valor1b = $value["json_pro_cantidad"] + $traerProducto["pro_stock"];
						$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
					}

					$tablaClientes = "clientes";

					$itemCliente = "cli_id";
					$valorCliente = $_POST["seleccionarCliente"];
					$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
					//var_dump($traerCliente);

					$item1a = "cli_compras";
					$valor1a = $traerCliente["cli_compras"] - array_sum($totalProductosComprados);
					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);


					/*=============================================
					ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
					=============================================*/

					$listaProductos_edit = json_decode($listaProductos, true);

					//var_dump($listaProductos);

					$totalProductosComprados_edit = array();

					foreach ($listaProductos_edit as $key => $value) {

						array_push($totalProductosComprados_edit, $value["json_pro_cantidad"]);

						$tablaProductos_edit = "productos";

						$item_edit = "pro_id";
						$valor_edit = $value["json_pro_id"];
						$orden = "pro_id";

						$traerProducto_edit = ModeloProductos::mdlMostrarProductos($tablaProductos_edit, $item_edit, $valor_edit,$orden);

						//var_dump($traerProducto["pro_ventas"]);

						$item1a_edit = "pro_ventas";
						$valor1a_edit = $value["json_pro_cantidad"] + $traerProducto_edit["pro_ventas"];

						$nuevasVentas_edit = ModeloProductos::mdlActualizarProducto($tablaProductos_edit, $item1a_edit, $valor1a_edit, $valor_edit);

						$item1b_edit = "pro_stock";
						$valor1b_edit = $value["json_pro_stock"];

						$nuevoStock_edit = ModeloProductos::mdlActualizarProducto($tablaProductos_edit, $item1b_edit, $valor1b_edit, $valor_edit);

					} 

					/**
					 * Traemos clientes
					 */
					
					$tablaClientes_edit = "clientes";

					$item_edit = "cli_id";
					$valor_edit = $_POST["seleccionarCliente"];

					$traerCliente_edit = ModeloClientes::mdlMostrarClientes($tablaClientes_edit, $item_edit, $valor_edit);
					//var_dump($traerCliente);

					$item1a_edit = "cli_compras";
					$valor1a_edit = array_sum($totalProductosComprados_edit) + $traerCliente_edit["cli_compras"];

					$comprasCliente_edit = ModeloClientes::mdlActualizarCliente($tablaClientes_edit, $item1a_edit, $valor1a_edit, $valor_edit);

					$item1b_edit = "cli_ultima_compra";

					date_default_timezone_set('America/Lima');

					$fecha_edit = date('Y-m-d');
					$hora_edit = date('H:i:s');
					$valor1b_edit = $fecha_edit.' '.$hora_edit;

					$fechaCliente_edit = ModeloClientes::mdlActualizarCliente($tablaClientes_edit, $item1b_edit, $valor1b_edit, $valor_edit); 
				}
					/*=============================================
					GUARDAR LA COMPRA
					=============================================*/	

					$tabla_edit = "ventas";

					$datos_edit = array("ven_id_vendedor"=>$_POST["idVendedor"],
								"ven_id_cliente"=>$_POST["seleccionarCliente"],
								"ven_codigo"=>$_POST["editarVenta"],
								"ven_productos"=>$listaProductos,
								"ven_impuesto"=>$_POST["nuevoPrecioImpuesto"],
								"ven_neto"=>$_POST["nuevoPrecioNeto"],
								"ven_total"=>$_POST["totalVenta"],
								"ven_metodo_pago"=>$_POST["listaMetodoPago"]);

					$respuesta_edit = ModeloVentas::mdlEditarVenta($tabla_edit, $datos_edit);

						if($respuesta_edit == "ok"){
							echo'<script>

							localStorage.removeItem("rango");

							swal({
								type: "success",
								title: "La venta ha sido actualizada correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then((result) => {
											if (result.value) {
											window.location = "ventas";
											}
										})
							</script>';
						}
		}

	}///Fin ctrEditarVenta



	static public function ctrEliminarVenta(){
		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "ven_id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			//var_dump($traerVenta);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);
		//	var_dump($traerVentas);


			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["ven_id_cliente"] == $traerVenta["ven_id_cliente"]){
					//var_dump($value["ven_fecha_create"]);

					array_push($guardarFechas, $value["ven_fecha_create"]);
					
				}
				//var_dump($guardarFechas);
			}

			if(count($guardarFechas) > 1){

				
				if($traerVenta["ven_fecha_create"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "cli_ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["ven_id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "cli_ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["ven_id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}

			}else{
				$item = "cli_ultima_compra";
				$valor = NULL;
				$valorIdCliente = $traerVenta["ven_id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
				$productos =  json_decode($traerVenta["ven_productos"], true);
					//var_dump($productos);
				$totalProductosComprados = array();

					foreach ($productos as $key => $value) {

						array_push($totalProductosComprados, $value["json_pro_cantidad"]);

						$tablaProductos = "productos";

						$item = "pro_id";
						$valor = $value["json_pro_id"];
						$orden = "pro_id";
						$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

						$item1a = "pro_ventas";
						$valor1a = $traerProducto["pro_ventas"] - $value["json_pro_cantidad"];
						$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

						$item1b = "pro_stock";
						$valor1b = $value["json_pro_cantidad"] + $traerProducto["json_pro_stock"];
						$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
					}

					$tablaClientes = "clientes";

					$itemCliente = "cli_id";
					$valorCliente = $_POST["seleccionarCliente"];
					$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);
					//var_dump($traerCliente);

					$item1a = "cli_compras";
					$valor1a = $traerCliente["cli_compras"] - array_sum($totalProductosComprados);
					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

					/*=============================================
					ELIMINAR VENTA
					=============================================*/

					$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

					if($respuesta == "ok"){

						echo'<script>
		
						swal({
							type: "success",
							title: "La venta ha sido borrada correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then((result) => {
										if (result.value) {
		
										window.location = "ventas";
		
										}
									})
		
						</script>';
		
					}	

		}

	}

		/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	
	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	static public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}





}//Fin de clase