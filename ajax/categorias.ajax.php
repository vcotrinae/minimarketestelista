<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxEditarCategoria(){
		$item = "cat_id";
		$valor = $this->idCategoria;
		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);	
		echo json_encode($respuesta); 
	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	

if(isset($_POST["idCategoria"])){

	$Categoria = new AjaxCategorias();
	$Categoria -> idCategoria = $_POST["idCategoria"];
	$Categoria -> ajaxEditarCategoria();
}
