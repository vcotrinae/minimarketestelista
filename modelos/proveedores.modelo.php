<?php

require_once __DIR__ . "/../config/conexion.php";


class ModeloProveedores{

    /**
     * MOSTAR ProveedoreS
     */

    static public function mdlMostrarProveedores($tabla, $item, $valor){
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
	CREAR ESTUDIANTES
	=============================================*/

	static public function mdlIngresarProveedor($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(prove_ruc, prove_razon_social, prove_nombre_comercial, prove_email, prove_telefono, prove_direccion) 
		VALUES (:prove_ruc, :prove_razon_social, :prove_nombre_comercial, :prove_email, :prove_telefono, :prove_direccion)");
		$stmt->bindParam(":prove_ruc", $datos["prove_ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_razon_social", $datos["prove_razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_nombre_comercial", $datos["prove_nombre_comercial"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_email", $datos["prove_email"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_telefono", $datos["prove_telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_direccion", $datos["prove_direccion"], PDO::PARAM_STR); 
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
	EDITAR ESTUDIANTE
	=============================================*/

	static public function mdlEditarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		prove_ruc = :prove_ruc, 
		prove_razon_social=:prove_razon_social, 
		prove_nombre_comercial=:prove_nombre_comercial, 
		prove_email=:prove_email, 
		prove_telefono=:prove_telefono, 
		prove_direccion=:prove_direccion 
		WHERE prove_id = :prove_id");

		$stmt->bindParam(":prove_ruc", $datos["prove_ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_razon_social", $datos["prove_razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_nombre_comercial", $datos["prove_nombre_comercial"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_email", $datos["prove_email"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_telefono", $datos["prove_telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":prove_direccion", $datos["prove_direccion"], PDO::PARAM_STR); 
		$stmt->bindParam(":prove_id", $datos["prove_id"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}
		$stmt->close();
		$stmt = null;
	}

		/*=============================================
	BORRAR ESTUDIANTE
	=============================================*/

	static public function mdlBorrarProveedor($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE prove_id = :prove_id");
		$stmt -> bindParam(":prove_id", $datos, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}



}//FIN CLASE