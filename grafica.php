<?php
$host = 'localhost';
$db   = 'temperaturas_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

    $stmt = $pdo->query("SELECT fecha, temperatura FROM temperatura ORDER BY id ASC");

    $fechas = [];
    $temps = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $fechas[] = $row['fecha'];
        $temps[] = $row['temperatura'];
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gráfica</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 600px; /* 🔥 más grande */
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}
</style>
</head>

<body>

<div class="container">
    <h3>📊 Temperaturas registradas</h3>
    <canvas id="grafica"></canvas>
</div>

<script>
const etiquetas = <?php echo json_encode($fechas); ?>;
const datos = <?php echo json_encode($temps); ?>;

new Chart(document.getElementById('grafica'), {
    type: 'line',
    data: {
        labels: etiquetas,
        datasets: [{
            label: 'Temperatura (°C)',
            data: datos,
            borderWidth: 2,
            tension: 0.3
        }]
    },
    options: {
        scales: {
            x: {
                ticks: {
                    maxRotation: 45,
                    minRotation: 45
                }
            },
            y: {
                beginAtZero: false
            }
        }
    }
});
</script>

<script>
setTimeout(() => location.reload(), 10000);
</script>

</body>
</html>