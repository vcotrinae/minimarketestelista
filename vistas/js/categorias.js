
/*=============================================
EDITAR Categoria
=============================================*/
$(".tablas").on("click", ".btnEditarCategoria", function(){
	var idCategoria = $(this).attr("idCategoria");   

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

   // console.log(idCategoria);
    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            //console.log('Respuesta del servidor:', respuesta);
            $("#editarCategoria").val(respuesta["cat_categoria"]);
            $("#editarId").val(respuesta["cat_id"]);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la llamada AJAX:", textStatus, errorThrown);
        }
    });   
});


/*=============================================
ELIMINAR Categoria
=============================================*/
$(".tablas").on("click", ".btnEliminarCategoria", function(){

    var idCategoria = $(this).attr("idCategoria");

    swal({
        title: '¿Está seguro de borrar Categoria?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar categoría!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

        }

    })

})