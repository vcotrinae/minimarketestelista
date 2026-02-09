<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class AjaxProveedores{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idProveedor; 

	public function ajaxEditarProveedor(){
		$item = "prove_id";
		$valor = $this->idProveedor;
		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);	
		echo json_encode($respuesta); 
	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	

if(isset($_POST["idProveedor"])){

	$proveedor = new AjaxProveedores();
	$proveedor -> idProveedor = $_POST["idProveedor"];
	$proveedor -> ajaxEditarProveedor();
}
