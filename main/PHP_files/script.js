google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawGaugeChart);

let gaugeChart;
let gaugeData;
let gaugeOptions;

function drawGaugeChart() {
    // Definir os dados do gráfico
    gaugeData = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['N.Água', 0],
        
    ]);

    // Definir as opções do gráfico
    gaugeOptions = {
        width: 220,
        height: 220,
        redFrom: 75,
        redTo: 100,
        yellowFrom: 25,
        yellowTo: 75,
        greenFrom: 0,
        greenTo: 25,
        minorTicks: 5,
        majorTicks: ['0', '5', '10', '15', '20', '25', '30'],
        animation: { duration: 4000, easing: 'out' },
        // Ajustar as cores conforme necessário
        colors: ['#00FF00', '#FFA500', '#FF0000']
    };

    // Criar o gráfico
    gaugeChart = new google.visualization.Gauge(document.getElementById('chart_div1'));
    gaugeChart.draw(gaugeData, gaugeOptions);
}



function updateGaugeChart(value) {
    let num;
    value = ((value*100)/25)-20;
    if(value < 0 ){
        gaugeData.setValue(0, 1, 0);
    }else{
        gaugeData.setValue(0, 1, value);
    }
    
    gaugeChart.draw(gaugeData, gaugeOptions);
    num = 100 - value;
    applyCustomColors(num);
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

// Configurações do gráfico de linha
const ctxLine = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Nível de Água',
            data: [],
            backgroundColor: 'rgba(52, 152, 219, 0.2)',
            borderColor: 'rgba(52, 152, 219, 1)',
            borderWidth: 1,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                type: 'time',
                time: {
                    unit: 'minute',
                    tooltipFormat: 'll HH:mm'
                },
                title: {
                    display: true,
                    text: 'Tempo'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Nível de Água'
                }
            }
        }
    }
});

function updateLineChart(timestamp, value) {
    lineChart.data.labels.push(timestamp);
    value = 100  - (value*100)/25
    if(value < 0){
    lineChart.data.datasets[0].data.push(0);}
    else{
        lineChart.data.datasets[0].data.push(value);

    }
    lineChart.update();
}

document.addEventListener("DOMContentLoaded", function() {
    socket = io('http://localhost:3000'); // Ajuste se necessário

    socket.on('data', function(data) {
        console.log('Dados recebidos do servidor:', data);
        const timestamp = new Date(data.timestamp);
        const value = parseFloat(data.value);
        updateGaugeChart(value);
        updateLineChart(timestamp, value);
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
        console.log('Resposta do servidor PHP:', data);
        showNotification(data);
    })
    .catch(error => {
        console.error('Erro ao enviar solicitação:', error);
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
