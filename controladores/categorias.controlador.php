<?php

class ControladorCategorias
{
 
	static public function ctrMostrarCategorias($item, $valor)
	{
		$tabla = 'categorias';
		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrCrearCategorias()
	{

		if (isset($_POST['nuevoCategoria'])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['nuevoCategoria'])) {
				$tabla = 'categorias';
				$datos = array(
					'cat_categoria' => $_POST['nuevoCategoria']
				);

				//var_dump($datos);

				$respuesta = ModeloCategorias::mdlCrearCategorias($tabla, $datos);
				//var_dump($respuesta);

				if ($respuesta == 'ok') {
					echo '<script>
					swal({
						  type: "success",
						  title: "La categoria ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "categorias";
									}
								})
					</script>';
				}
			} else {
				echo '<script>
					swal({
						  type: "error",
						  title: "¡La categoria no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "categorias";
							}
						})
			  	</script>';
			}
		}
	}


	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCategoria(){

		if(isset($_POST["editarCategoria"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){
				$tabla = "categorias";
				$datos = array(
					"cat_categoria"=>$_POST["editarCategoria"], 
					"cat_id"=>$_POST["editarId"]
				);
				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);
				if($respuesta == "ok"){
					echo'<script>
					swal({
						  type: "success",
						  title: " Datos de la categoría han sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "categorias";
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
							window.location = "categorias";
							}
						})
			  	</script>';
			}
		}
	}



	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarCategoria()
	{
		if (isset($_GET["idCategoria"])) {
			$tabla = "categorias";
			$datos = $_GET["idCategoria"];
			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);
			if ($respuesta == "ok") {
				echo '<script>
					swal({
						  type: "success",
						  title: "Datos de la categoría ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "categorias";
									}
								})
					</script>';
			}
		}
	}
}//Fin Class
