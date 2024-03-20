<?php
require_once("php/header.php");
?>

<section class="divider_150px"><!-- space between ad and welcome section --></section>

    <div class="dashboard-container">
        <!-- Chart 1 -->
        <div class="dashboard-chart-container">
            <canvas id="chart1" width="400" height="300"></canvas>
        </div>
        <!-- Chart 2 -->
        <div class="dashboard-chart-container">
            <canvas id="chart2" width="400" height="300"></canvas>
        </div>
        <!-- Chart 3 -->
        <div class="dashboard-chart-container">
            <canvas id="chart3" width="400" height="300"></canvas>
        </div>
        <!-- Chart 4 -->
        <div class="dashboard-chart-container">
            <canvas id="chart4" width="400" height="300"></canvas>
        </div>
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>

        // Array of maximum values for each chart
        const maxValues = [200, 150, 180, 170];

    // Function to generate random data
    function generateRandomData(maxValue) {
        const data = {};
        const months = ["04", "05", "06", "07", "08", "09", "10", "11", "12", "01", "02", "03"];
        const currentYear = new Date().getFullYear();
        
        for (let i = 0; i < months.length; i++) {
            const key = `${months[i]}-${currentYear}`;
            data[key] = Math.floor(Math.random() * maxValue) + 1; // Generating random number between 1 and 100
        }
        
        return data;
    }


        
    // Function to create a chart
    function createChart(canvasId, label, dataValues, maxValue) {
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
                        suggestedMax: maxValue
                    }
                }
            }
        });
    }

        // Create four charts with different data
        createChart('chart1', 'opgewekte energie', generateRandomData(maxValues[0]), maxValues[0]);
        createChart('chart2', 'opgewekte energie', generateRandomData(maxValues[1]), maxValues[1]);
        createChart('chart3', 'opgewekte energie', generateRandomData(maxValues[2]), maxValues[2]);
        createChart('chart4', 'opgewekte energie', generateRandomData(maxValues[3]), maxValues[3]);
    </script>
</body>
</html>

<?php
require_once("php/footer.php");
?>