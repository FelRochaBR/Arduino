<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge', 'corechart']}); // Adicionado 'corechart'
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data1 = google.visualization.arrayToDataTable([
          ['Rótulo', 'Valor'],
          ['Motor', 10],
          ['N.Água', 10],
          ['Rede', 68]
        ]);

        var data2 = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Trabalho',     11],
          ['Lazer',      2],
          ['Comer',  2],
          ['TV', 2],
          ['Sono',    7]
        ]);

        var data3 = google.visualization.arrayToDataTable([
          ['Tempo', 'Trabalho', 'Lazer', 'Comer', 'TV', 'Sono'],
          ['Segunda', 8, 2, 2, 2, 10],
          ['Terça', 7, 3, 2, 1, 11],
          ['Quarta', 8, 2, 3, 1, 10],
          ['Quinta', 7, 2, 2, 2, 11],
          ['Sexta', 8, 2, 2, 1, 11],
          ['Sábado', 9, 1, 1, 2, 11],
          ['Domingo', 9, 1, 1, 2, 11]
        ]);

        var options1 = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var options2 = {
          title: 'Distribuição do Tempo',
          pieHole: 0.4,
        };

        var options3 = {
          title: 'Uso do Tempo por Dia',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
 
        var chart1 = new google.visualization.Gauge(document.getElementById('chart_div1'));
        chart1.draw(data1, options1);

        var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);

        var chart3 = new google.visualization.LineChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }
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
            width: 80%; /* Aumentei o tamanho do dashboard para acomodar o novo gráfico */
            position: relative;
        }
        .options {
            width: 200px;
            background-color:  rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
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
        .container {
            flex: 1;
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
            margin-bottom: 1cm; /* Espaço de 1cm abaixo dos botões */
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
            margin: 0 0.2cm; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 40;
        }
        .inputSubmit_on
        {
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
        <div class="container">
            <div class="button-container">
                <form action="#" method="POST">
                    <input class="inputSubmit_on" type="submit" name="submit" value="Ligar">
                </form>
                <form action="#" method="POST">
                    <input class="inputSubmit_off" type="submit" name="submit" value="Desligar">
                </form>
            </div>
            <div class="chart" id='chart_div1'></div> <!-- Adicionado o primeiro gráfico -->
        </div>
        <div class="container">
            <div class="chart" id='chart_div3'></div> <!-- Adicionado o terceiro gráfico -->
        </div>
        <div class="container">
            <form action="#" method="POST">
                <div class="chart" id='chart_div2'></div> <!-- Adicionado o segundo gráfico -->
            </form>
        </div>
    </div>
</body>
</html>
