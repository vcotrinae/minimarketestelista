<?php

class ControladorProveedores
{
 
	static public function ctrMostrarProveedores($item, $valor)
	{
		$tabla = 'proveedores';
		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrCrearProveedor()
	{

		if (isset($_POST['nuevoRuc'])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoRuc'])) {
				$tabla = 'proveedores';
				$datos = array(
					'prove_ruc' => $_POST['nuevoRuc'],
					'prove_razon_social' => $_POST['nuevoRazonSocial'],
					'prove_nombre_comercial' => $_POST['nuevoNombreComercial'],
					'prove_email' => $_POST['nuevoEmail'],
					'prove_telefono' => $_POST['nuevoTelefono'],
					'prove_direccion' => $_POST['nuevoDireccion'] 
				);

				//var_dump($datos);

				$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);
				//var_dump($respuesta);


				if ($respuesta == 'ok') {

					echo '<script>

					swal({
						  type: "success",
						  title: "El proveedor ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';
				}
			} else {
				echo '<script>
					swal({
						  type: "error",
						  title: "¡El proveedor no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "proveedores";
							}
						})
			  	</script>';
			}
		}
	}

	/**
	 * EDITAR PROVEEDOR
	 */

	 static public function ctrEditarProveedor(){

		if(isset($_POST["editarRuc"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarRuc"])){
				$tabla = "proveedores";
				$datos = array(
					"prove_ruc"=>$_POST["editarRuc"],
					"prove_razon_social"=>$_POST["editarRazonSocial"],
					"prove_nombre_comercial"=>$_POST["editarNombreComercial"],
					"prove_email"=>$_POST["editarEmail"],
					"prove_telefono"=>$_POST["editarTelefono"],
					"prove_direccion"=>$_POST["editarDireccion"], 
					"prove_id"=>$_POST["idProveedor"]
				);
				$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);
				if($respuesta == "ok"){
					echo'<script>
					swal({
						  type: "success",
						  title: " Datos del proveedor han sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "proveedores";
									}
								})
					</script>';
				}
			}else{
				echo'<script>
					swal({
						  type: "error",
						  title: "¡ Los campos no pueden ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "proveedores";
							}
						})
			  	</script>';
			}
		}
	}



	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarProveedor()
	{
		if (isset($_GET["idProveedor"])) {
			$tabla = "proveedores";
			$datos = $_GET["idProveedor"];
			$respuesta = ModeloProveedores::mdlBorrarProveedor($tabla, $datos);
			if ($respuesta == "ok") {
				echo '<script>
					swal({
						  type: "success",
						  title: "Datos del proveedor ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "proveedores";
									}
								})
					</script>';
			}
		}
	}





}//Fin Class
