<?php
require_once("php/header.php");

redirect_user();
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

        // set maximum- and minimum value for each chart
        const maxValues = [300, 250, 30, 60];
        const minValues = [100, 200, 10, 10];

    // Function to generate random data
    function generateRandomData(maxValue, minimum) {
        const data = {};
        const months = ["Jan.", "Feb.", "Mrt.", "Apr.", "Mei", "Jun.", "Jul.", "Aug.", "Sep.", "Okt.", "Nov.", "Dec."];
        const currentYear = new Date().getFullYear();
        
        //generate a random data between the minimum- and maximum value for every month
        for (let i = 0; i < months.length; i++) {
            const key1 = `${months[i]}`;
            data[key1] = Math.floor(Math.random() * (maxValue - minimum + 1)) + minimum;
        }
        
        return data;
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

        // Create four charts with different data
        createChart('chart1', 'line', 'Vermogen', generateRandomData(maxValues[0], minValues[0]), maxValues[0], minValues[0], "In watt", ["#cad8de", "#637ba0"]);
        createChart('chart2', 'bar', 'Spanning', generateRandomData(maxValues[1], minValues[1]), maxValues[1], minValues[1], "In volt", ["#cad8de", "#637ba0"]);
        createChart('chart3', 'bar', 'Opbrengst per kWh', generateRandomData(maxValues[2], minValues[2]), maxValues[2], minValues[2], "In eurocent", ["#fff3d0", "#e9c973"]);
        createChart('chart4', 'line', 'Temperatuur', generateRandomData(maxValues[3], minValues[3]), maxValues[3], minValues[3], "In celcius", ["#fff3d0", "#e9c973"]);
    </script>
</body>
</html>

<?php
require_once("php/footer.php");
?>