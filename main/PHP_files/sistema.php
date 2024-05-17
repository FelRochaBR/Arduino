<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
      google.load('visualization', '1', {packages:['gauge']});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Rótulo', 'Valor'],
          ['Motor', 10],
          ['N.Água', 10],
          ['Rede', 68]
        ]);
 
        var options = {
          width: 400, height: 120,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
 
        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        chart.draw(data, options);
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
            width: 50%;
            position: relative;

        }
        .options {
            width: 200px;
            background-color:  rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 1cm; /* Espaço de 1cm abaixo dos botões */
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
            <div id='chart_div'></div>
        </div>
    </div>
</body>
</html>
