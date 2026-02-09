<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoProducto(){

    $item = "pro_id_categoria";
    $valor = $this->idCategoria;
    $orden = "pro_id";

    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

    echo json_encode($respuesta);

  }

    /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto(){

    if ($this->traerProductos=="ok") {
      $item = null;
      $valor = null;
      $orden = "pro_id";
      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
      echo json_encode($respuesta);
       
    }elseif($this->nombreProducto !=""){
      $item = "pro_descripcion";
      $valor = $this->nombreProducto;
      $orden = "pro_id";
      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
      echo json_encode($respuesta);
    }

    else{
      $item = "pro_id";
      $valor = $this->idProducto;
      $orden = "pro_id";
      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
      echo json_encode($respuesta);
    }

  }


}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/ 

if(isset($_POST["idCategoria"])){

  $codigoProducto = new AjaxProductos();
  $codigoProducto -> idCategoria = $_POST["idCategoria"];
  $codigoProducto -> ajaxCrearCodigoProducto();

}

/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER  PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}

/*=============================================
TRAER nombre PRODUCTO
=============================================*/ 

if(isset($_POST["nombreProducto"])){

  $nombreProductos = new AjaxProductos();
  $nombreProductos -> nombreProducto = $_POST["nombreProducto"];
  $nombreProductos -> ajaxEditarProducto();

}



