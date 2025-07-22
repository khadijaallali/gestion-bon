<canvas id="carburantChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('carburantChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Essence', 'Diesel'],
            datasets: [{
                label: 'Quantité consommée (litres)',
                data: [{{ $totalEssence }}, {{ $totalGasoil }}],
                backgroundColor: ['#ff6384', '#36a2eb']
            }]
        }
    });
</script>
