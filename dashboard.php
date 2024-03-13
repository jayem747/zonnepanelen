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
            <canvas id="chart1"></canvas>
        </div>
        <!-- Chart 2 -->
        <div class="chart-container">
            <canvas id="chart2"></canvas>
        </div>
        <!-- Chart 3 -->
        <div class="chart-container">
            <canvas id="chart3"></canvas>
        </div>
        <!-- Chart 4 -->
        <div class="chart-container">
            <canvas id="chart4"></canvas>
        </div>
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        // JavaScript to create charts (you need to replace this with actual chart data)
        // Example chart data
        const chartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Chart 1 Data',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: [65, 59, 80, 81, 56, 55, 40],
            }]
        };

        // Chart configuration
        const chartConfig = {
            type: 'line',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        // Render charts
        const charts = document.querySelectorAll('.chart-container canvas');
        charts.forEach((chart, index) => {
            const ctx = chart.getContext('2d');
            const config = Object.assign({}, chartConfig); // Clone config
            config.data.datasets[0].label = `Chart ${index + 1} Data`; // Update label
            new Chart(ctx, config);
        });
    </script>
</body>
</html>

<?php
require_once("php/footer.php");
?>