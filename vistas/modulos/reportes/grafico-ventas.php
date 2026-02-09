<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
} else {
    $fechaInicial = null;
    $fechaFinal = null;
}

$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

$arrayFechas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {
    # Capturamos sólo el año y el mes
    $fecha = substr($value["ven_fecha_create"], 0, 7); // 'YYYY-MM'
    
    # Introducir las fechas en arrayFechas
    if (!isset($sumaPagosMes[$fecha])) {
        $sumaPagosMes[$fecha] = 0; // Inicializamos el total si no existe
    }
    
    # Sumamos las ventas al mes correspondiente
    $sumaPagosMes[$fecha] += $value["ven_total"];
}

# Convertir arrays a formato adecuado para JavaScript
$fechasJS = json_encode(array_keys($sumaPagosMes));
$ventasJS = json_encode(array_values($sumaPagosMes));

?>



<!--=====================================
GRÁFICO DE VENTAS
======================================-->

<!-- solid sales graph -->
<div class="card bg-gradient-info">
    <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Grafico de Ventas
        </h3>

        <div class="card-tools">
            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <canvas class="chart" id="line-chart-ventas"
            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>    
    <!-- /.card-footer -->
</div>
<!-- /.card -->


<script>
    // Sales graph chart
    var salesGraphChartCanvas = $('#line-chart-ventas').get(0).getContext('2d');

    var salesGraphChartData = {
        labels: <?php echo $fechasJS; ?>, // Usar las fechas generadas
        datasets: [
            {
                label: 'Ventas',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#efefef',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '#efefef',
                pointBackgroundColor: '#efefef',
                data: <?php echo $ventasJS; ?> // Usar los totales de ventas generados
            }
        ]
    };

    var salesGraphChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                ticks: {
                    fontColor: '#efefef'
                },
                gridLines: {
                    display: false,
                    color: '#efefef',
                    drawBorder: false
                }
            }],
            yAxes: [{
                ticks: {
                    stepSize: 5000,
                    fontColor: '#efefef',
                    callback: function(value) {
                        return 'S/. ' + value; // Agregar símbolo de dólar en el eje Y
                    }
                },
                gridLines: {
                    display: true,
                    color: '#efefef',
                    drawBorder: false
                }
            }]
        }
    };

    var salesGraphChart = new Chart(salesGraphChartCanvas, {
        type: 'line',
        data: salesGraphChartData,
        options: salesGraphChartOptions
    });
</script>





