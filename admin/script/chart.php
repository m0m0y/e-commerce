<script>
    const labels = [<?= $date_data ?>];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Order By Date',
            data: [<?= $date_data ?>],
            backgroundColor: 'transparent',
            borderColor:'rgb(47, 92, 182)'
        },

        {
            label: 'Sales',
            data: [<?= $total_data ?>],
            backgroundColor: 'transparent',
            borderColor:'rgb(204, 0, 0)'
        },

        {
            label: 'Number of Orders: <?= $rowcount ?>',
            backgroundColor: 'transparent',
            borderColor:'rgb(255, 128, 0)'
        },]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            mode: 'index',
            legend:{display: true, position: 'top', labels: {fontColor: 'black', fontSize: 15}}
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>