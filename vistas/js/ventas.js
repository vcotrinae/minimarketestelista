/*$.ajax({
  url: "ajax/datatable-ventas.ajax.php",
  success: function (respuesta) {
    console.log("respuesta", respuesta);
  },
});
*/

$(document).ready(function () {
  $("#tablaVentasProductosAjax").DataTable({
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
    buttons: [],
    ajax: "ajax/datatable-ventas.ajax.php",
  });
});

/*============================================= 
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(document).ready(function () {
  $(".tablaVentas tbody").on("click", "button.agregarProducto", function () {
    var idProducto = $(this).attr("idProducto");
    //console.log("idProducto:", idProducto);

    $(this).removeClass("btn btn-primary agregarProducto");

    $(this).addClass("btn btn-default");

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
        // console.log(respuesta);

        var descripcion = respuesta["pro_descripcion"];
        var stock = respuesta["pro_stock"];
        var precio = respuesta["pro_precio_venta"];

        /*=============================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=============================================*/

        if (stock == 0) {
          swal({
            title: "No hay stock disponible",
            type: "error",
            confirmButtonText: "¡Cerrar!",
          });

          $("button[idProducto='" + idProducto + "']").addClass(
            "btn-primary agregarProducto"
          );
          return;
        }

        $(".nuevoProducto").append(
          '<div class="row ">' +
            '<div class="col-7">' +
            '    <div class="input-group mb-3">' +
            '        <div class="input-group-prepend">' +
            '            <button type="button" class="btn btn-danger quitarProducto" idProducto="' +
            idProducto +
            '"><i class="fa fa-times"></i></button>' +
            "        </div>" +
            '        <input type="text" class="form-control nuevaDescripcionProducto" idProducto="' +
            idProducto +
            '" id="agregarProducto" name="agregarProducto" value="' +
            descripcion +
            '" readonly required>' +
            "    </div>" +
            "</div>" +
            '<div class="col-2 ">' +
            '    <input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="' +
            stock +
            '" nuevoStock="' +
            Number(stock - 1) +
            '" required>' +
            "</div>" +
            '<div class="col-3 ingresoPrecio">' +
            '    <div class="input-group mb-3">' +
            '        <div class="input-group-prepend">' +
            '            <span class="input-group-text">' +
            "                <strong> S/.</strong>" +
            "            </span>" +
            "        </div>" +
            '        <input type="text" min="1" class="form-control nuevoPrecioProducto" precioReal="' +
            precio +
            '" name="nuevoPrecioProducto" value="' +
            precio +
            '" readonly required>' +
            "    </div>" +
            "    </div>" +
            "</div>"
        );

        // SUMAR TOTAL DE PRECIOS
        sumarTotalPrecios();

        // AGREGAR IMPUESTO
        agregarImpuesto();

        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProductos();

        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

        $(".nuevoPrecioProducto").number(true, 2);
      },
    });
  });
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function () {
  if (localStorage.getItem("quitarProducto") != null) {
    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for (var i = 0; i < listaIdProductos.length; i++) {
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).addClass("btn-primary agregarProducto");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function () {
  $(this).parent().parent().parent().parent().remove();

  var idProducto = $(this).attr("idProducto");
  //console.log("idProducto", idProducto);

  /*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

  if (localStorage.getItem("quitarProducto") == null) {
    idQuitarProducto = [];
  } else {
    idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
  }

  idQuitarProducto.push({ idProducto: idProducto });

  localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

  $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass(
    "btn-primary agregarProducto"
  );

  if ($(".nuevoProducto").children().length == 0) {
    $("#nuevoImpuestoVenta").val(0);
    $("#nuevoTotalVenta").val(0);
    $("#totalVenta").val(0);
    $("#nuevoTotalVenta").attr("total", 0);
  } else {
    // SUMAR TOTAL DE PRECIOS
    sumarTotalPrecios();

    // AGREGAR IMPUESTO
    agregarImpuesto();

    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarProductos();
  }
});

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/
var numProducto = 0;

$(".btnAgregarProducto").click(function () {
  numProducto++;

  var datos = new FormData();
  datos.append("traerProductos", "ok");

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      // console.log("respues", respuesta);

      $(".nuevoProducto").append(
        '<div class="row ">' +
          '<div class="col-7">' +
          '    <div class="input-group mb-3">' +
          '        <div class="input-group-prepend">' +
          '            <button type="button" class="btn btn-danger quitarProducto" idProducto><i class="fa fa-times"></i></button>' +
          "        </div>" +
          '<select class="form-control nuevaDescripcionProducto " id="producto' +
          numProducto +
          '" idProducto name="nuevaDescripcionProducto" required>' +
          '<option value="">Seleccione producto</option> ' +
          "</select>" +
          "    </div>" +
          "</div>" +
          '<div class="col-2 ingresoCantidad">' +
          '    <input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock  required>' +
          "</div>" +
          '<div class="col-3 ingresoPrecio">' +
          '    <div class="input-group mb-3">' +
          '        <div class="input-group-prepend">' +
          '            <span class="input-group-text">' +
          "                <strong> S/.</strong>" +
          "            </span>" +
          "        </div>" +
          '        <input type="text" min="1" class="form-control nuevoPrecioProducto" precioReal=""  name="nuevoPrecioProducto" readonly required>' +
          "    </div>" +
          "    </div>" +
          "</div>"
      );

      // AGREGAR LOS PRODUCTOS AL SELECT
      respuesta.forEach(funcionForEach);

      function funcionForEach(item, index) {
        if (item.pro_stock != 0) {
          $("#producto" + numProducto).append(
            '<option idProducto="' +
              item.pro_id +
              '" value="' +
              item.pro_descripcion +
              '">' +
              item.pro_descripcion +
              "</option>"
          );
        }
      }

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPrecios();

      // AGREGAR IMPUESTO

      agregarImpuesto();

      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
      $(".nuevoPrecioProducto").number(true, 2);
    },
  });
});

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on(
  "change",
  "select.nuevaDescripcionProducto",
  function () {
    var nombreProducto = $(this).val();

    // Corregir la selección de
    var nuevaDescripcionProducto = $(this)
      .closest(".row")
      .find(".nuevaDescripcionProducto");
    var nuevoPrecioProducto = $(this)
      .closest(".row")
      .find(".ingresoPrecio .nuevoPrecioProducto");
    var nuevaCantidadProducto = $(this)
      .closest(".row")
      .find(".ingresoCantidad .nuevaCantidadProducto");

    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        //console.log("RPTA", respuesta);

        $(nuevaDescripcionProducto).attr("idProducto", respuesta["pro_id"]);
        $(nuevaCantidadProducto).attr("stock", respuesta["pro_stock"]);
        $(nuevaCantidadProducto).attr(
          "nuevoStock",
          Number(respuesta["pro_stock"]) - 1
        );
        $(nuevoPrecioProducto).val(respuesta["pro_precio_venta"]);
        $(nuevoPrecioProducto).attr(
          "precioReal",
          respuesta["pro_precio_venta"]
        );

        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProductos();
      },
    });
  }
);

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function () {
  var precio = $(this)
    .closest(".row")
    .find(".ingresoPrecio .nuevoPrecioProducto");

  var precioFinal = $(this).val() * precio.attr("precioReal");
  //console.log("precioFinal: ", precioFinal);

  precio.val(precioFinal);

  var nuevoStock = Number($(this).attr("stock")) - $(this).val();

  $(this).attr("nuevoStock", nuevoStock);

  if (Number($(this).val()) > Number($(this).attr("stock"))) {
    /*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

    $(this).val(1);

    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);

    // SUMAR TOTAL DE PRECIOS
    sumarTotalPrecios();

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });

    return;
  }
  // SUMAR TOTAL DE PRECIOS
  sumarTotalPrecios();
  //
  // AGREGAR IMPUESTO
  agregarImpuesto();
  // AGRUPAR PRODUCTOS EN FORMATO JSON
  listarProductos();
});

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios() {
  var precioItem = $(".nuevoPrecioProducto");
  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  //console.log("erro",sumaTotalPrecio)

  $("#nuevoTotalVenta").val(sumaTotalPrecio);
  $("#totalVenta").val(sumaTotalPrecio);
  $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto() {
  var impuesto = $("#nuevoImpuestoVenta").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");

  var precioImpuesto = Number((precioTotal * impuesto) / 100);

  var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

  $("#nuevoTotalVenta").val(totalConImpuesto);

  $("#totalVenta").val(totalConImpuesto);

  $("#nuevoPrecioImpuesto").val(precioImpuesto);

  $("#nuevoPrecioNeto").val(precioTotal);
}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function () {
  agregarImpuesto();
});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function () {
  var metodo = $(this).val();
  console.log("metodo", metodo);

  if (metodo == "Efectivo") {
    $(this) // Este 'this' debería referirse al elemento del select
      .closest(".row") // Navega hacia el padre más cercano con la clase 'row'
      .find(".metodoPagoTransaccion") // Busca el div que tiene la clase 'metodoPagoTransaccion'
      .html(
        '<label for="Monto efectivo">Monto de efectivo</label>' +
          '<div class="input-group mb-3">' +
          '<div class="input-group-prepend">' +
          '<span class="input-group-text">' +
          "<strong> S/.</strong>" +
          "</span>" +
          "</div>" +
          '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>' +
          "</div>" +
          '<label for="Monto Cambio">Monto de cambio</label>' +
          '<div class="input-group mb-3 capturarCambioEfectivo" id="capturarCambioEfectivo">' +
          ' <div class="input-group-prepend">' +
          '<span class="input-group-text">' +
          "<strong> S/.</strong>" +
          "</span>" +
          "</div>" +
          '<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>' +
          " </div>"
      );

    // Agregar formato al precio

    $("#nuevoValorEfectivo").number(true, 2);
    $("#nuevoCambioEfectivo").number(true, 2);

    // Listar método en la entrada
    listarMetodos();
  } else {
    $(this) // Este 'this' debería referirse al elemento del select
      .closest(".row") // Navega hacia el padre más cercano con la clase 'row'
      .find(".metodoPagoTransaccion") // Busca el div que tiene la clase 'metodoPagoTransaccion'
      .html(
        '<label for="Codigo de Transaccion">Código de Transacción</label>' +
          '<div class="input-group mb-3">' +
          '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required>' +
          '<div class="input-group-prepend">' +
          '<span class="input-group-text">' +
          '<i class="fa fa-lock"></i>' +
          "</span>" +
          " </div>" +
          "</div>"
      );
  }
});

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function () {
  var efectivo = Number($(this).val()); // Convertir a número
  var totalVenta = Number($("#nuevoTotalVenta").val()); // Total de la venta
  var nuevoCambioEfectivo = $(this)
    .closest(".row")
    .find("#nuevoCambioEfectivo");

  // Validar que el monto efectivo no sea menor que el total de la venta
  if (efectivo < totalVenta) {
    // Mostrar un mensaje de error o alertar al usuario        alert("El monto de efectivo debe ser igual o mayor que el total de la compra.");

    swal({
      title:
        "El monto de efectivo debe ser igual o mayor que el total de la compra.",
      text: "¡Monto de compra " + totalVenta + " soles!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });

    nuevoCambioEfectivo.val(""); // Limpiar el campo de cambio
  } else {
    var cambio = efectivo - totalVenta; // Calcular el cambio
    nuevoCambioEfectivo.val(cambio); // Actualizar el campo de cambio
  }
});

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function () {
  // Listar método en la entrada
  listarMetodos();
});

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos() {
  var listaProductos = [];

  var descripcion = $(".nuevaDescripcionProducto");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPrecioProducto");

  for (var i = 0; i < descripcion.length; i++) {
    listaProductos.push({
      json_pro_id: $(descripcion[i]).attr("idProducto"),
      json_pro_descripcion: $(descripcion[i]).val(),
      json_pro_cantidad: $(cantidad[i]).val(),
      json_pro_stock: $(cantidad[i]).attr("nuevoStock"),
      json_pro_precio: $(precio[i]).attr("precioReal"),
      json_pro_total: $(precio[i]).val(),
    });
  }

  //console.log("Lista producto : ", listaProductos);

  $("#listaProductos").val(JSON.stringify(listaProductos));
}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos() {
  var listaMetodos = "";

  if ($("#nuevoMetodoPago").val() == "Efectivo") {
    $("#listaMetodoPago").val("Efectivo");
  } else {
    $("#listaMetodoPago").val(
      $("#nuevoMetodoPago").val() + "-" + $("#nuevoCodigoTransaccion").val()
    );
  }
}

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function () {
  var idVenta = $(this).attr("idVenta");

  window.location = "index.php?ruta=editar-venta&idVenta=" + idVenta;
});

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto() {
  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idProductos = $(".quitarProducto");
  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for (var i = 0; i < idProductos.length; i++) {
    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idProductos[i]).attr("idProducto");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (var j = 0; j < botonesTabla.length; j++) {
      if ($(botonesTabla[j]).attr("idProducto") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
        $(botonesTabla[j]).addClass("btn-default");
      }
    }
  }
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$(".tablaVentas").on("draw.dt", function () {
  quitarAgregarProducto();
});

/*=============================================
ELIMINAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function () {
  var idVenta = $(this).attr("idVenta");

  swal({
    title: "¿Está seguro de borrar la venta?",
    text: "¡Si no lo está puede cancelar la accíón!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, borrar venta!",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=ventas&idVenta=" + idVenta;
    }
  });
});

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function () {
  var codigoVenta = $(this).attr("codigoVenta");

  //window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");
  window.open("lib/fpdf/factura.php?codigo=" + codigoVenta, "_blank");
  //window.open("lib/fpdf/factura.php", "_blank");
  //window.open("vistas/modulos/factura.php", "_blank");
});

/*=============================================
RANGO DE FECHAS
=============================================*/

$("#daterange-btn").daterangepicker(
  {
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Último mes": [
        moment().subtract(1, "month").startOf("month"),
        moment().subtract(1, "month").endOf("month"),
      ],
    },
    startDate: moment(),
    endDate: moment(),
  },
  function (start, end) {
    $("#daterange-btn span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango = $("#daterange-btn span").html();

    localStorage.setItem("capturarRango", capturarRango);

    window.location =
      "index.php?ruta=ventas&fechaInicial=" +
      fechaInicial +
      "&fechaFinal=" +
      fechaFinal;
  }
);

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on(
  "click",
  function () {
    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "ventas";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function () {
  var textoHoy = $(this).attr("data-range-key");

  if (textoHoy == "Hoy") {
    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var año = d.getFullYear();

    if (mes < 10) {
      var fechaInicial = año + "-0" + mes + "-" + dia;
      var fechaFinal = año + "-0" + mes + "-" + dia;
    } else if (dia < 10) {
      var fechaInicial = año + "-" + mes + "-0" + dia;
      var fechaFinal = año + "-" + mes + "-0" + dia;
    } else if (mes < 10 && dia < 10) {
      var fechaInicial = año + "-0" + mes + "-0" + dia;
      var fechaFinal = año + "-0" + mes + "-0" + dia;
    } else {
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
    }

    localStorage.setItem("capturarRango", "Hoy");

    window.location =
      "index.php?ruta=ventas&fechaInicial=" +
      fechaInicial +
      "&fechaFinal=" +
      fechaFinal;
  }
});
