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
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .chart-container {
            margin-left: 30px;
            width: 40%;
            margin-bottom: 30px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .table-container {
            margin-left: 30px;
            width: 40%;
            margin-bottom: 30px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 30px;
        }

        p {
            font-size: 20px;
            margin-bottom: 30px;
            margin-left: 17%;
        }

    </style>
</head>
<body>
   
<section class="divider_150px"><!-- space between ad and welcome section --></section>
<p>Ontdek het krachtige resultaat van zonne-energie! Op deze pagina zie je het totale energieopwekkingsoverzicht van onze geïnstalleerde zonnepanelen per maand.
    <br>Bekijk hoeveel groene energie we hebben geproduceerd en draag bij aan een duurzamere wereld.</p>
    <div class="container">
        <!-- Chart 1 -->
        <div class="chart-container">
            <canvas id="chart1" width="800" height="750"></canvas>
        </div>
        <!-- Table 1 -->
        <div class="table-container">
        </div>
    </div>


    <!-- Include Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        // Sample data for each chart (replace this with your actual data)
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
            let tableHTML = '<table border="1"><tr><th>Maand-Jaar</th><th>Opgewekte energie</th></tr>';
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