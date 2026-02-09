<?php

require_once __DIR__ . "/../config/conexion.php";


class ModeloProductos{

    /**
     * MOSTAR ProductoS
     */

    static public function mdlMostrarProductos($tabla, $item, $valor, $orden){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY pro_id DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR );
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

		/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(pro_id_categoria, pro_id_proveedor, pro_codigo, pro_descripcion, pro_imagen, pro_stock, pro_precio_compra, pro_precio_venta) VALUES (:pro_id_categoria, :pro_id_proveedor, :pro_codigo, :pro_descripcion, :pro_imagen, :pro_stock, :pro_precio_compra, :pro_precio_venta)");

		$stmt->bindParam(":pro_id_categoria", $datos["pro_id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":pro_id_proveedor", $datos["pro_id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":pro_codigo", $datos["pro_codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_descripcion", $datos["pro_descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_imagen", $datos["pro_imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_stock", $datos["pro_stock"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_precio_compra", $datos["pro_precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_precio_venta", $datos["pro_precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pro_id_categoria = :pro_id_categoria, pro_id_proveedor = :pro_id_proveedor, pro_descripcion = :pro_descripcion, pro_imagen = :pro_imagen, pro_stock = :pro_stock, pro_precio_compra = :pro_precio_compra, pro_precio_venta = :pro_precio_venta WHERE pro_codigo = :pro_codigo");

		$stmt->bindParam(":pro_id_categoria", $datos["pro_id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":pro_id_proveedor", $datos["pro_id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":pro_codigo", $datos["pro_codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_descripcion", $datos["pro_descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_imagen", $datos["pro_imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_stock", $datos["pro_stock"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_precio_compra", $datos["pro_precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":pro_precio_venta", $datos["pro_precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;

	}

/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE pro_id = :pro_id");
		$stmt -> bindParam(":pro_id", $datos, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}

		/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE pro_id = :pro_id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":pro_id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}

		/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(pro_ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}


}//Fin clase