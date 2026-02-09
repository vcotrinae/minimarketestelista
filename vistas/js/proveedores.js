
/*=============================================
EDITAR ESTUDIANTE
=============================================*/
$(".tablas").on("click", ".btnEditarProveedor", function(){
	var idProveedor = $(this).attr("idProveedor");   

	var datos = new FormData();
	datos.append("idProveedor", idProveedor);

   // console.log(idEstudiante);
    $.ajax({
        url: "ajax/proveedores.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            //console.log('Respuesta del servidor:', respuesta);
            $("#editarRuc").val(respuesta["prove_ruc"]);
            $("#editarRazonSocial").val(respuesta["prove_razon_social"]);
            $("#editarNombreComercial").val(respuesta["prove_nombre_comercial"]);
            
            $("#editarEmail").val(respuesta["prove_email"]);

            $("#editarTelefono").val(respuesta["prove_telefono"]);
            $("#editarDireccion").val(respuesta["prove_direccion"]); 
            $("#idProveedor").val(respuesta["prove_id"]);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la llamada AJAX:", textStatus, errorThrown);
        }
    });   
});


/*=============================================
ELIMINAR ESTUDIANTE
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedor", function(){

    var idProveedor = $(this).attr("idProveedor");

    swal({
        title: '¿Está seguro de borrar proveedor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar proveedor!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=proveedores&idProveedor="+idProveedor;

        }

    })

})