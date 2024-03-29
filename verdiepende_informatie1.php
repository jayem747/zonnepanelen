<?php
require_once("php/header.php");
?>

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
            width: 100%;
            height: 20vh; /* 20% of the viewport height */
            background-image: url('img/solar-energy.jpg');
            background-size: cover;
            background-position: center;
            margin-top: 5%;
            margin-bottom: 2%;
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
            margin-right: 30px;
            width: 40%;
            margin-bottom: 30px;
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

    </style>
</head>
<body>

<div class="image-container">
    <p class="centered-text">Ontdek het krachtige resultaat van zonne-energie! Op deze pagina zie je het totale energieopwekkingsoverzicht van onze geïnstalleerde zonnepanelen per maand. Bekijk hoeveel groene energie we hebben geproduceerd en draag bij aan een duurzamere wereld.</p>
</div>

    <div class="container">
        <!-- Chart 1 -->
        <div class="chart-container">
            <canvas id="chart1" width="800" height="435"></canvas>
        </div>
        <!-- Table 1 -->
        <div class="table-container">
        </div>
    </div>


    <!-- Include Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        const data1 = {
            "04-2023": 35,
            "05-2023": 45,
            "06-2023": 50,
            "07-2023": 60,
            "08-2023": 55,
            "09-2023": 65,
            "10-2023": 70,
            "11-2023": 75,
            "12-2023": 80,
            "01-2024": 85,
            "02-2024": 90,
            "03-2024": 95
        };

        // Function to create a chart
        function createChart(canvasId, label, dataValues) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: Object.keys(dataValues),
                    datasets: [{
                        label: label,
                        data: Object.values(dataValues),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Month-Year'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'hoeveel opgewekte energie'
                            },
                            suggestedMin: 0,
                            suggestedMax: 200
                        }
                    }
                }
            });
        }
        createChart('chart1', 'opgewekte energie', data1);

        function createTable(data) {
            let tableHTML = '<table border="0"><tr><th>Maand-Jaar</th><th>Opgewekte energie</th></tr>';
            Object.keys(data).forEach(key => {
                tableHTML += `<tr><td>${key}</td><td>${data[key]}</td></tr>`;
            });
            tableHTML += '</table>';
            return tableHTML;
        }

        document.querySelector('.table-container').innerHTML = createTable(data1);


    </script>
</body>
</html>

<?php
require_once("php/footer.php");
?>