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
        /* Define CSS styles for the dashboard layout */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;

        }
        .chart-container {
            width: 45%;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

    </style>
</head>
<body>
<section class="divider_150px"><!-- space between ad and welcome section --></section>

    <div class="container">
        <!-- Chart 1 -->
        <div class="chart-container">
            <canvas id="chart1" width="400" height="300"></canvas>
        </div>
        <!-- Chart 2 -->
        <div class="chart-container">
            <canvas id="chart2" width="400" height="300"></canvas>
        </div>
        <!-- Chart 3 -->
        <div class="chart-container">
            <canvas id="chart3" width="400" height="300"></canvas>
        </div>
        <!-- Chart 4 -->
        <div class="chart-container">
            <canvas id="chart4" width="400" height="300"></canvas>
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

        const data2 = {
            "04-2023": 20,
            "05-2023": 30,
            "06-2023": 40,
            "07-2023": 50,
            "08-2023": 60,
            "09-2023": 70,
            "10-2023": 80,
            "11-2023": 90,
            "12-2023": 100,
            "01-2024": 110,
            "02-2024": 120,
            "03-2024": 130
        };

        const data3 = {
            "04-2023": 10,
            "05-2023": 20,
            "06-2023": 30,
            "07-2023": 40,
            "08-2023": 50,
            "09-2023": 60,
            "10-2023": 70,
            "11-2023": 80,
            "12-2023": 90,
            "01-2024": 100,
            "02-2024": 110,
            "03-2024": 120
        };

        const data4 = {
            "04-2023": 50,
            "05-2023": 60,
            "06-2023": 70,
            "07-2023": 80,
            "08-2023": 90,
            "09-2023": 100,
            "10-2023": 110,
            "11-2023": 120,
            "12-2023": 130,
            "01-2024": 140,
            "02-2024": 150,
            "03-2024": 160
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
                            suggestedMax: 200 // Adjust max value as needed
                        }
                    }
                }
            });
        }

        // Create four charts with different data
        createChart('chart1', 'opgewekte energie', data1);
        createChart('chart2', 'opgewekte energie', data2);
        createChart('chart3', 'opgewekte energie', data3);
        createChart('chart4', 'opgewekte energie', data4);
    </script>
</body>
</html>

<?php
require_once("php/footer.php");
?>