<div class="flex flex-col md:flex-row items-center justify-around w-full bg-gray-100 p-10 mt-8" id="chartMenu">

    <div class="w-full md:w-1/3 min-h-full mx-10">
        <canvas id="myChart" height="250px"></canvas>
    </div>

    <div class="w-full md:w-1/3 min-h-full mx-10">
        <canvas id="myDonut"></canvas>
    </div>

</div>

<!----------------------------- Chart script ----------------------------------->
<script>
    <?php $data = $m->chart(); ?>

    var labels = <?php echo json_encode($data['day']); ?>;
    var data = {
        labels: labels,
        datasets: [{
                label: 'recovered',
                backgroundColor: 'rgb(18, 210, 56)',
                borderColor: 'rgb(18, 210, 56)',
                data: <?php echo json_encode($data['recovered']); ?>
            },
            {
                label: 'confirmed cases',
                backgroundColor: 'rgb(255, 162, 0)',
                borderColor: 'rgb(255, 162, 0)',
                data: <?php echo json_encode($data['confirmed_cases']); ?>,
            },
            {
                label: 'death',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php echo json_encode($data['death']); ?>,
            }
        ]
    };

    var config = {
        type: 'line',
        data,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Evolution Covid19 in Morocco'
                }
            }
        }
    };

    var myChart = new Chart(document.getElementById('myChart'), config);
</script>
<!----------------------------- Chart script ----------------------------------->

<!----------------------------- doughnut  chart script ----------------------------------->

<script>
    <?php $data = $m->doughnut(); ?>

    const DATA_COUNT = 5;
    const COLORS = ['rgb(255, 99, 132)', 'rgb(255, 162, 0)', 'rgb(18, 210, 56)', 'rgb(18, 161, 234)', 'rgb(245, 14, 247)', 'rgb(71, 225, 175)', 'rgb(255, 134, 85)', 'rgb(255, 255, 1)', 'rgb(152, 251, 152)', 'rgb(32, 178, 170)', 'rgb(245, 222, 179)', 'rgb(148, 0, 211)'];
    const NUMBER_CFG = {
        count: DATA_COUNT,
        min: 0,
        max: 100
    };

    data = {
        labels: <?php echo json_encode($data['label']); ?>,
        datasets: [{
            label: 'Dataset 1',
            data: <?php echo json_encode($data['data']); ?>,
            backgroundColor: COLORS,
        }]
    };

    config = {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Corona Virus Distribution By Regions'
                }
            }
        },
    };

    var myChart = new Chart(document.getElementById('myDonut'), config);
</script>
<!----------------------------- doughnut  chart script ----------------------------------->