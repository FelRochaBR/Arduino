<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Referência ao arquivo CSS separado -->
</head>
<body>
    <div class="dashboard">
        <div class="options">
            <ul>
                <li><a href="#">Gráfico</a></li>
                <li><a href="calendario.php">Calendário</a></li>
                <li><a href="#">Configurações</a></li>
                <li><a href="#">Informações</a></li>
                <li><a href="introducao.php">Sair</a></li>
            </ul>
        </div>
        <div class="containers">
            <div class="container">
                <div class="button-container">
                    <button id="startBtn" class="inputSubmit_on">Ligar</button>
                    <button id="stopBtn" class="inputSubmit_off">Desligar</button>
                </div>
                <div class="chart" id="chart_div1"></div>
            </div>
            <div class="container2">
                <div class="chart">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div id="notification" class="notification"></div>

    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script src="script.js"></script> <!-- Script JavaScript separado -->
</body>
</html>
