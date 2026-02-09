<?php

require_once __DIR__ . "/../config/conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/ 

	static public function mdlMostrarVentas($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY ven_id ASC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY ven_id ASC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}		
		$stmt -> close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ven_codigo, ven_id_cliente, ven_id_vendedor, ven_productos, ven_impuesto, ven_neto, ven_total, ven_metodo_pago) VALUES (:ven_codigo, :ven_id_cliente, :ven_id_vendedor, :ven_productos, :ven_impuesto, :ven_neto, :ven_total, :ven_metodo_pago)");

		$stmt->bindParam(":ven_codigo", $datos["ven_codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":ven_id_cliente", $datos["ven_id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":ven_id_vendedor", $datos["ven_id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":ven_productos", $datos["ven_productos"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_impuesto", $datos["ven_impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_neto", $datos["ven_neto"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_total", $datos["ven_total"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_metodo_pago", $datos["ven_metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt->close();
		$stmt = null;

	}

/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  ven_id_cliente = :ven_id_cliente, ven_id_vendedor = :ven_id_vendedor, ven_productos = :ven_productos, ven_impuesto = :ven_impuesto, ven_neto = :ven_neto, ven_total= :ven_total, ven_metodo_pago = :ven_metodo_pago WHERE ven_codigo = :ven_codigo");

		$stmt->bindParam(":ven_codigo", $datos["ven_codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":ven_id_cliente", $datos["ven_id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":ven_id_vendedor", $datos["ven_id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":ven_productos", $datos["ven_productos"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_impuesto", $datos["ven_impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_neto", $datos["ven_neto"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_total", $datos["ven_total"], PDO::PARAM_STR);
		$stmt->bindParam(":ven_metodo_pago", $datos["ven_metodo_pago"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ven_id = :ven_id");

		$stmt -> bindParam(":ven_id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";		
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentasD($tabla, $fechaInicial, $fechaFinal) {
		if ($fechaInicial == null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY ven_id ASC");
			$stmt->execute();
			return $stmt->fetchAll();    
		} else if ($fechaInicial == $fechaFinal) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ven_fecha_create = :ven_fecha_create");
			$stmt->bindParam(":ven_fecha_create", $fechaFinal, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		} else {
			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");
	
			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
	
			if ($fechaFinalMasUno == $fechaActualMasUno) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ven_fecha_create BETWEEN :fechaInicial AND :fechaFinalMasUno");
				$stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
				$stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
			} else {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ven_fecha_create BETWEEN :fechaInicial AND :fechaFinal");
				$stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
				$stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
			}        
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY ven_id ASC");
			$stmt -> execute();
			return $stmt -> fetchAll();	

		}else if($fechaInicial == $fechaFinal){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ven_fecha_create like '%$fechaFinal%'");
			//$stmt -> bindParam(":ven_fecha_create", $fechaFinal, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ven_fecha_create BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ven_fecha_create BETWEEN '$fechaInicial' AND '$fechaFinal'");
			}		
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
	}

		
		/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ven_neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


}//FIN DE CLASE