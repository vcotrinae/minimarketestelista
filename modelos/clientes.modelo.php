<?php

require_once __DIR__ . "/../config/conexion.php";


class ModeloClientes{

    /**
     * MOSTAR CategoriaS
     */

    static public function mdlMostrarClientes($tabla, $item, $valor){
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
	CREAR CLIENTE
	=============================================*/

	static public function mdlCrearCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cli_nombre, cli_documento, cli_email, cli_telefono, cli_direccion, cli_fecha_nacimiento) VALUES (:cli_nombre, :cli_documento, :cli_email, :cli_telefono, :cli_direccion, :cli_fecha_nacimiento)");

		$stmt->bindParam(":cli_nombre", $datos["cli_nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_documento", $datos["cli_documento"], PDO::PARAM_INT);
		$stmt->bindParam(":cli_email", $datos["cli_email"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_telefono", $datos["cli_telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_direccion", $datos["cli_direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_fecha_nacimiento", $datos["cli_fecha_nacimiento"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
	}
	
	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cli_nombre = :cli_nombre, cli_documento = :cli_documento, cli_email = :cli_email, cli_telefono = :cli_telefono, cli_direccion = :cli_direccion, cli_fecha_nacimiento = :cli_fecha_nacimiento, cli_fecha_update = :cli_fecha_update WHERE cli_id = :cli_id");

		$stmt->bindParam(":cli_id", $datos["cli_id"], PDO::PARAM_INT);
		$stmt->bindParam(":cli_nombre", $datos["cli_nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_documento", $datos["cli_documento"], PDO::PARAM_INT);
		$stmt->bindParam(":cli_email", $datos["cli_email"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_telefono", $datos["cli_telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_direccion", $datos["cli_direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_fecha_nacimiento", $datos["cli_fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":cli_fecha_update", $datos["cli_fecha_update"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;

	}

 /*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cli_id = :cli_id");
		$stmt -> bindParam(":cli_id", $datos, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE cli_id = :cli_id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":cli_id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;

	}


}// Fin Class
