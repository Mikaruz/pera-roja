<?php include('templates/header.php');
include("config/db.php"); ?>

<?php

$sentenceSQL = $conection->prepare("SELECT * FROM orders WHERE DATE(timestamp) = CURDATE();");
$sentenceSQL->execute();
$clientesDataList = $sentenceSQL->fetchAll(PDO::FETCH_ASSOC);




foreach ($clientesDataList as $item) {

    $orderid = $item['id'];

    $sqlItem = $conection->prepare("SELECT * FROM ordersitems WHERE orderid = $orderid");
    $sqlItem->execute();
    $filaitem = $sqlItem->fetchAll(PDO::FETCH_ASSOC);
}

?>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([

            ['Task', 'Hours per Day'],

            <?php
            foreach ($clientesDataList as $item) {
                $orderid = $item['id'];

                $sqlItem = $conection->prepare("SELECT * FROM ordersitems WHERE orderid = $orderid");
                $sqlItem->execute();
                $filaitem = $sqlItem->fetchAll(PDO::FETCH_ASSOC);

                foreach ($filaitem as $item2) {
                    $platoid = $item2['productid'];
                    $sqlCliente = "SELECT * FROM platos WHERE id = $platoid";
                    $resultado1 = mysqli_query($conexion, $sqlCliente);
                    $fila = mysqli_fetch_assoc($resultado1);
                    echo "['" . $fila['nombre'] . "', " . $item2['quantity'] . "],";
                }
            } ?>
        ]);

        var options = {
            title: 'Platos más vendidos del día',
            sliceVisibilityThreshold: .05
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);




        google.charts.load("current", {
            packages: ["corechart", "bar"]
        });
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {
            var data = new google.visualization.DataTable();
            data.addColumn("timeofday", "Time of Day");
            data.addColumn("number", "Ventas");

            data.addRows([
                <?php
                $horaInicial = 8;
                $horaFinal = 19;

                for ($i = $horaInicial; $i < $horaFinal; $i++) {
                    $horaSiguiente = $i + 1;

                    $horaQuery = $conection->prepare("SELECT COUNT(*) as count FROM orders WHERE DATE(timestamp) = CURDATE() AND HOUR(timestamp) >= $i AND HOUR(timestamp) < $horaSiguiente");
                    $horaQuery->execute();
                    $resultadoHora = $horaQuery->fetch(PDO::FETCH_ASSOC);
                    $cantidadHora = $resultadoHora['count'];

                    echo "[{v: [$i, 0, 0], f: '$i hrs'}, $cantidadHora],";
                }
                ?>
            ]);
            var options = {
                title: "Ventas del día",
                hAxis: {
                    format: "h:mm a",
                    viewWindow: {
                        min: [7, 30, 0],
                        max: [18, 30, 0],
                    },
                },
                vAxis: {

                },
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById("chart_div")
            );

            chart.draw(data, options);
        }

    }
</script>
<h2 class="title">Panel de control</h2>
<div class="container">
    <div id="chart_div"></div>
    <div class="piechart-container">
        <div id="piechart" class="piechart" style="width: 900px; height: 500px;"></div>
    </div>

</div>