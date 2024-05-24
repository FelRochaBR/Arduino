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

      let chart1, data1, options1, socket;

      function drawChart() {
        data1 = google.visualization.arrayToDataTable([
          ['Rótulo', 'Valor'],
          ['N.Água', 0],
          ['Motor', 0],
        ]);

        options1 = {
          width: 300,
          height: 300,
          redFrom: 50,
          redTo: 100,
          yellowFrom: 25,
          yellowTo: 50,
          greenFrom: 0,
          greenTo: 25,
          minorTicks: 5,
          majorTicks: ['0', '20', '45', '100', '+150'],
          animation: { duration: 1000, easing: 'out' },
          colors: ['#00FF00', '#FFA500', '#FF0000']
        };

        chart1 = new google.visualization.Gauge(document.getElementById('chart_div1'));
        chart1.draw(data1, options1);

        // Repeat for other charts (chart2, chart3, chart4) as needed
      }

      function updateChart1(value) {
        data1.setValue(0, 1, value);
        chart1.draw(data1, options1);

        applyCustomColors(value);
      }

      function applyCustomColors(value) {
        const colors = {
          verde: '#00FF00',
          laranja: '#FFA500',
          vermelho: '#FF0000'
        };

        let color;
        if (value >= 0 && value <= 20) {
          color = colors.verde;
        } else if (value > 20 && value <= 45) {
          color = colors.laranja;
        } else {
          color = colors.vermelho;
        }

        document.querySelectorAll('.google-visualization-gauge .google-visualization-gauge-label text').forEach((label, index) => {
          if (index === 0) {
            label.setAttribute('fill', color);
          }
        });
      }

      document.addEventListener("DOMContentLoaded", function() {
        socket = io('http://localhost:3000'); // Ajuste se necessário

        socket.on('data', function(data) {
          console.log(data);
          updateChart1(parseFloat(data.value));
        });

        document.getElementById('startBtn').addEventListener('click', function(event) {
          event.preventDefault();
          sendRequest('start_node_server.php');
        });

        document.getElementById('stopBtn').addEventListener('click', function(event) {
          event.preventDefault();
          sendRequest('stop_node_server.php');
          socket.disconnect();
          setTimeout(() => {
            location.reload();
          }, 5000);
        });
      });

      function sendRequest(url) {
        fetch(url, {
          method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
          showNotification(data);
        })
        .catch(error => {
          showNotification('Ocorreu um erro: ' + error);
        });
      }

      function showNotification(message) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.style.display = 'block';
        setTimeout(() => {
          notification.style.display = 'none';
        }, 5000);
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
        }
        .options {
            width: 220px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 20px;
            border-radius: 20px;
            margin: 20px;
            height: calc(100vh - 50px);
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
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 20px;
            flex: 1;
            margin: 20px;
        }
        .container, .container1, .container2, .container3 {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 300px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .inputSubmit_on, .inputSubmit_off {
            background-color: #2980b9;
            border: none;
            padding: 12px;
            color: white;
            font-size: 18px;
            cursor: pointer;
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
            margin-top: 20px;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            border-radius: 5px;
            display: none;
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
                    <button id="startBtn" class="inputSubmit_on">Ligar</button>
                    <button id="stopBtn" class="inputSubmit_off">Desligar</button>
                </div>
                <div class="chart" id='chart_div1'></div>
            </div>
            <div class="container1">
                <div class="chart" id='chart_div2'></div>
            </div>
            <div class="container2">
                <div class="chart" id='chart_div3'></div>
            </div>
            <div class="container3">
                <div class="chart" id='chart_div4'></div>
            </div>
        </div>
    </div>
    <div id="notification" class="notification"></div>
</body>
</html>
