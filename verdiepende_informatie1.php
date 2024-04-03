<?php
require_once("php/header.php");
?>

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