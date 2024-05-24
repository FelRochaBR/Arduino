const { SerialPort } = require('serialport');
const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const cors = require('cors');
const fs = require('fs');
const { inserirDadosDoJson } = require('./database');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"]
  }
});

app.use(cors());
app.use(express.static('public'));

app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

server.listen(3000, () => {
  console.log('Servidor iniciado na porta 3000');
});

const readline = require('readline');
const arduino = new SerialPort({ path: 'COM4', baudRate: 9600 });
const rl = readline.createInterface({ input: arduino });

arduino.on('open', () => {
  console.log('Conexão Serial Iniciada');
});

rl.on('line', (line) => {
  const distancia = line;
  console.log('Nível da aproximação:', distancia);

  const data = {
    timestamp: new Date().toISOString().replace(/T/, ' ').replace(/\..+/, ''),
    value: line.trim()
  };

  const jsonData = JSON.stringify(data);
  const filename = 'dados.json';

  fs.appendFile(filename, jsonData + '\n', (err) => {
    if (err) {
      console.error('Erro ao gravar no arquivo:', err);
    } else {
      console.log('Dados gravados com sucesso!');
      inserirDadosDoJson(filename);
      io.emit('data', data);
    }
  });
});

app.get('/parar', (req, res) => {
  console.log('Recebida solicitação para parar o servidor');
  server.close(() => {
    console.log('Servidor parado');
    process.exit(0);
  });
  res.send('Servidor sendo encerrado...');
});
