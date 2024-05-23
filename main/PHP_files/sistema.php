<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge', 'corechart']});
      google.setOnLoadCallback(drawChart);

      let chart1, data1;

      function drawChart() {
        data1 = google.visualization.arrayToDataTable([
          ['Rótulo', 'Valor'],
          ['N.Água', 0],
          ['Motor', 0],
          ['Rede', 0]
        ]);

        var options1 = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom: 75, yellowTo: 90,
          minorTicks: 5
        };

        chart1 = new google.visualization.Gauge(document.getElementById('chart_div1'));
        chart1.draw(data1, options1);
      }

      function updateChart1(value) {
        data1.setValue(0, 1, value);
        chart1.draw(data1,options2);
        chart1 = new google.visualization.Gauge(document.getElementById('chart_div1'));
        var options2 = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom: 75, yellowTo: 90,
          minorTicks: 5
        };
      }

      document.addEventListener("DOMContentLoaded", function() {
        const socket = io('http://localhost:3002'); // Adjust if necessary

        socket.on('data', function(data) {
          console.log(data);
          updateChart1(parseFloat(data.value));
        });
      });
    </script>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #2c3e50, #3498db);
        }
        .dashboard {
            display: flex;
            height: 100vh;
        }
        .options {
            width: 200px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            height: calc(100vh - 10px);
            box-sizing: border-box;
            line-height: 1.5em;
        }
        .options ul {
            list-style-type: none;
            padding: 0;
        }
        .options ul li {
            padding: 10px 0;
            border-bottom: 1px solid #666;
        }
        .options ul li:last-child {
            border-bottom: none;
        }
        .options ul li a {
            color: #fff;
            text-decoration: none;
        }
        .options ul li a:hover {
            color: rgb(130, 130, 255);
        }
        .containers {
            display: flex;
            flex-direction: column;
            flex: 1;
            margin: 20px;
        }
        .container, .container1, .container2 {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container2 {
            flex: 2;
            background-color:  rgba(0, 0, 0, 0.5);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px; /* Espaço de 20px abaixo dos botões */
        }
        .inputSubmit_on, .inputSubmit_off {
            background-color: #2980b9;
            border: none;
            padding: 12px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 0 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 120px; 
            border-radius: 90px;
        }
        .inputSubmit_on {
            background-color: blue;
        }
        .inputSubmit_off {
            background-color: red;
        }
        .inputSubmit_on:hover, .inputSubmit_off:hover {
            background-color: rgb(130, 130, 255);
        }
        .chart {
            margin-top: 20px; /* Espaço entre os gráficos */
        }
    </style>
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
                    <form action="start_node_server.php" method="POST">
                        <input class="inputSubmit_on" type="submit" name="submit" value="Ligar">
                    </form>
                    <form action="stop_node_server.php" method="POST">
                        <input class="inputSubmit_off" type="submit" name="submit" value="Desligar">
                    </form>
                </div>
                <div class="chart" id='chart_div1'></div> <!-- Adicionado o primeiro gráfico -->
            </div>
            <div class="container1">
                <div class="chart" id='chart_div3'></div> <!-- Adicionado o terceiro gráfico -->
            </div>
            <div class="container2">
                <div class="chart" id='chart_div2'></div> <!-- Adicionado o segundo gráfico -->
            </div>
        </div>
    </div>
</body>
</html>
