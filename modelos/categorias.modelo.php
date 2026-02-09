<?php

require_once __DIR__ . "/../config/conexion.php";


class ModeloCategorias{

    /**
     * MOSTAR CategoriaS
     */

    static public function mdlMostrarCategorias($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR );
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

	
	/*=============================================
	CREAR CategoriaS
	=============================================*/

	static public function mdlCrearCategorias($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cat_categoria)  VALUES (:cat_categoria)");
		$stmt->bindParam(":cat_categoria", $datos["cat_categoria"], PDO::PARAM_STR); 
		//var_dump($stmt);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	EDITAR Categoria
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		cat_categoria = :cat_categoria  WHERE cat_id = :cat_id");

		$stmt->bindParam(":cat_categoria", $datos["cat_categoria"], PDO::PARAM_STR); 
		$stmt->bindParam(":cat_id", $datos["cat_id"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
	}

		/*=============================================
	BORRAR Categoria
	=============================================*/

	static public function mdlBorrarCategoria($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cat_id = :cat_id");
		$stmt -> bindParam(":cat_id", $datos, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}
}// Fin Class
