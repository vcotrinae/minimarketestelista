/*$.ajax({
  url: "ajax/datatable-productos.ajax.php",
  success: function (respuesta) {
    console.log("respuesta", respuesta);
  },
});*/
var perfilOculto = $("#perfilOculto").val();

$(document).ready(function () {
  $("#tablaProductosAjax").DataTable({
    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando...",
    },
    //para usar los botones
    responsive: "true",
    dom: "Bfrtilp",
    buttons: [
      {
        extend: "copy",
        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Copiar',
        titleAttr: "Copiar",
        className: "btn btn-dark",
      },
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i> Excel',
        titleAttr: "Exportar a Excel",
        className: "btn btn-success",
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fas fa-file-pdf"></i> PDF',
        titleAttr: "Exportar a PDF",
        className: "btn btn-danger",
      },
      {
        extend: "csv",
        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> CSV',
        titleAttr: "Exportar a CSV",
        className: "btn btn-success",
      },
      {
        extend: "print",
        text: '<i class="fa fa-print"></i> Imprimir',
        titleAttr: "Imprimir",
        className: "btn btn-info",
      },
      {
        extend: "colvis",
        text: '<i class="fa fa-compress"></i> Visibilidad',
        titleAttr: "Visibilidad",
        className: "btn btn-light",
      },
    ],
    ajax: "ajax/datatable-productos.ajax.php",
  });
});

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
$("#nuevaCategoria").change(function () {
  var idCategoria = $(this).val();

  // console.log(idCategoria);

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (!respuesta) {
        var nuevoCodigo = idCategoria + "001";
        $("#nuevoCodigo").val("PROD-" + nuevoCodigo);
      } else {
        var codigoCompleto = respuesta["pro_codigo"];
        var numero = codigoCompleto.split("-")[1];
        var nuevoCodigo = Number(numero) + 1;
        var nuevoCodigoStr = nuevoCodigo.toString().padStart(3, "0");
        $("#nuevoCodigo").val("PROD-" + nuevoCodigoStr);
      }
    },
  });
});

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function () {
  if ($(".porcentaje").prop("checked")) {
    var valorPorcentaje = $(".nuevoPorcentaje").val();

    var porcentaje =
      Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje =
      Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly", true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function () {
  if ($(".porcentaje").prop("checked")) {
    var valorPorcentaje = $(this).val();

    var porcentaje =
      Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje =
      Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) +
      Number($("#editarPrecioCompra").val());

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly", true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});

$(".porcentaje").on("ifUnchecked", function () {
  $("#nuevoPrecioVenta").prop("readonly", false);
  $("#editarPrecioVenta").prop("readonly", false);
});

$(".porcentaje").on("ifChecked", function () {
  $("#nuevoPrecioVenta").prop("readonly", true);
  $("#editarPrecioVenta").prop("readonly", true);
});

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function () {
  var imagen = this.files[0];

  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaImagen").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaImagen").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;

      $(".previsualizar").attr("src", rutaImagen);
    });
  }
});
 
/*=============================================
EDITAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function () {
  var idProducto = $(this).attr("idProducto");
  //console.log("idproro", idProducto);

  var datos = new FormData();
  datos.append("idProducto", idProducto);

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      //console.log("RESPUESTA",respuesta);

      var datosCategoria = new FormData();
      datosCategoria.append("idCategoria", respuesta["pro_id_categoria"]);

      $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datosCategoria,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          //console.log("rpta_cate: ",respuesta);
          $("#editarCategoria").val(respuesta["cat_id"]);
          $("#editarCategoriaName").val(respuesta["cat_categoria"]);
        },
      });

      var datosProveedor = new FormData();
      datosProveedor.append("idProveedor", respuesta["pro_id_proveedor"]);
      $.ajax({
        url: "ajax/proveedores.ajax.php",
        method: "POST",
        data: datosProveedor,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          // console.log("rpta_provee: ",respuesta);
          $("#editarProveedor").val(respuesta["prove_id"]);
          //$("#editarCategoria").html(respuesta["categoria"]);
        },
      });

      $("#editarCodigo").val(respuesta["pro_codigo"]);

      $("#editarDescripcion").val(respuesta["pro_descripcion"]);

      $("#editarStock").val(respuesta["pro_stock"]);

      $("#editarPrecioCompra").val(respuesta["pro_precio_compra"]);

      $("#editarPrecioVenta").val(respuesta["pro_precio_venta"]);

      if (respuesta["pro_imagen"] != "") {
        $("#imagenActual").val(respuesta["pro_imagen"]);

        $(".previsualizar").attr("src", respuesta["pro_imagen"]);
      }
    },
  });
});

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto",  function () {
    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");

    swal({
      title: "¿Está seguro de borrar el producto?",
      text: "¡Si no lo está puede cancelar la accíón!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar producto!",
    }).then(function (result) {
      if (result.value) {
        window.location =
          "index.php?ruta=productos&idProducto=" + idProducto + "&imagen=" + imagen + "&codigo=" + codigo;
      }
    });
  }
);
