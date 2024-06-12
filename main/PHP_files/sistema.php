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
                <img src="imagens/logo6.png" alt="Logo" class="logo">
                <li><a href="cadastro.php">Cadastro</a></li>
                <li><a href="informacao.php">Sobre nós</a></li>
                <li><a href="introducao.php">Sair</a></li>
            </ul>
        </div>
        <div class="containers">
            <div class="top-row">
                <div class="container">
                    <div class="button-container">
                        <button id="startBtn" class="inputSubmit_on">Ligar</button>
                        <button id="stopBtn" class="inputSubmit_off">Desligar</button>
                    </div>
                    <div class="chart" id="chart_div1"></div>
                </div>
                <div class="container">
                    <iframe src="calendario.php" frameborder="0" class="iframe-calendar"></iframe>
                </div>
            </div>
            <div class="bottom-row">
                <div class="container">
                    <div class="chart">
                        <canvas id="lineChart"></canvas>
                    </div>
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

<style>
.logo {
    max-width: 80%;
    margin-bottom: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.containers {
    display: flex;
    flex-direction: column;
}

.top-row, .bottom-row {
    display: flex;
    justify-content: space-between;
}

.container {
    flex: 1;
    margin: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 400px; /* Altura padrão para todos os containers */
}

.iframe-calendar {
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 20px;
    background-color: #214661;
}

.chart {
    width: 100%;
    height: 100%;
}
</style>
