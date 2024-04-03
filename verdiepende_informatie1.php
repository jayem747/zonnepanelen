<?php
require_once("php/header.php");
?>

<<<<<<< Updated upstream
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Include CSS stylesheets for the dashboard -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.css">
    <style>

        .image-container {
            position: relative;
            overflow-x: hidden;
            width: 100.5vw;
            height: 20vh; /* 20% of the viewport height */
            background-image: url('img/solar-energy.jpg');
            background-size: cover;
            background-position: center;
            transform: translateX(-90px);
        }

        .centered-text {
            position: absolute;
            top: 50%;
            left: 33%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            width: 80%; 
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .chart-container {
            width: 50%;
            border: 1px solid #637A9F;
            padding: 10px;
            height: 30%;
        }

        .table-container {
            margin-left: 30px;
            width: 40%;
            margin-bottom: 30px;
            border: 10px #ccc;
            border-radius: 30px;
        }

        .table-container table td {
            padding: 4px;
        }


        .table-container table tr:nth-child(odd) {
            background-color: #FFFAE9; /*background for odd rows */
        }

        .table-container table tr:nth-child(even) {
            background-color: #fff; /* no background for even rows */
        }


        .table-container table {
            width: 100%;
            font-size: 20px;
            border-collapse: collapse;
            border-color: #637A9F;
        }

        .table-container table tr:first-child {
            background-color: #C9D7DD;
            padding: 10px;
        }

        p {
            font-size: 20px;
            margin-bottom: 30px;
            margin-left: 17%;
        }

        a.dashboard-link {
            justify-content: center;
            display: flex;
        }

    </style>
</head>
<body>
>>>>>>> Stashed changes
<div class="main_content">
    <div class="image-container">
        <p class="centered-text">Ontdek het krachtige resultaat van zonne-energie! Op deze pagina zie je het totale energieopwekkingsoverzicht van onze geïnstalleerde zonnepanelen per maand. Bekijk hoeveel groene energie we hebben geproduceerd en draag bij aan een duurzamere wereld.</p>
    </div>
    <section class="divider_50px"><!-- divider --></section>

    <div class="container">
        <!-- Chart 1 -->
        <div class="chart-container">
            <canvas id="chart1" width="650" height="350"></canvas>
        </div>
        <!-- Table 1 -->
        <div class="table-container">
            
        </div>
    </div>


    <!-- Include Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>

    let sharedRandomData;
        
    function generateRandomData(maxValue, minimum) {
        if (!sharedRandomData) {
            sharedRandomData = {};
            const months = ["Jan.", "Feb.", "Mrt.", "Apr.", "Mei", "Jun.", "Jul.", "Aug.", "Sep.", "Okt.", "Nov.", "Dec."];
            const currentYear = new Date().getFullYear();
            
            //generate a random data between the minimum- and maximum value for every month
            for (let i = 0; i < months.length; i++) {
                const key1 = `${months[i]}`;
                sharedRandomData[key1] = Math.floor(Math.random() * (maxValue - minimum + 1)) + minimum;
            }
        }
        
        return sharedRandomData;
    }


    // Function to create a chart
    function createChart(canvasId, bar_type, label, dataValues, maxValue, minValue , y_descr, color_chart) {
        const ctx = document.getElementById(canvasId).getContext('2d');
        new Chart(ctx, {
            type: bar_type,
            data: {
                // set label (months) and their y values
                labels: Object.keys(dataValues),
                datasets: [{
                    label: label,
                    data: Object.values(dataValues),
                    backgroundColor: color_chart[0],
                    borderColor: color_chart[1],
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                devicePixelRatio: 4,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Maand-Jaar'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: y_descr
                        },
                        min: minValue,
                        max: maxValue
                    }
                }
            }
        });
    }
        createChart('chart1', '<?= $_GET["type"] ?>', '<?= $_GET["naam"]?>', generateRandomData(<?= $_GET["max"] ?>, <?= $_GET["min"] ?>), <?= $_GET["max"] ?>, <?= $_GET["min"] ?>, '<?= $_GET["desc"] ?>', ['#<?= $_GET["color1"] ?>', '#<?= $_GET["color2"] ?>']);

        function createTable(data) {
            let tableHTML = '<table border="0"><tr><th>Maand-Jaar</th><th><?= $_GET["naam"] ?></th></tr>';
            Object.keys(data).forEach(key => {
                tableHTML += `<tr><td>${key}</td><td>${data[key]}</td></tr>`;
            });
            tableHTML += '</table>';
            return tableHTML;
        }

        document.querySelector('.table-container').innerHTML = createTable(sharedRandomData);


    </script>
</div>

<?php
require_once("php/footer.php");
?>