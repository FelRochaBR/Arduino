const { SerialPort } = require('serialport');
const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const fs = require('fs');
const { inserirDadosDoJson } = require('./database');
const app = express();
const server = http.createServer(app);
const io = socketIo(server);
app.use(express.static('public'));
app.get('/', (req, res, next) => {
  res.sendFile(__dirname + '/index.html');
});

server.listen(3002, () => {
  console.log('Servidor iniciado na porta 3002');
});

const readline = require('readline');
const arduino = new SerialPort({ path: 'COM3', baudRate: 9600 });
const rl = readline.createInterface({ input: arduino });
arduino.on('open', () => {
  console.log('Conexão Serial Iniciada');
  //teste emitindo grafico
 
  //teste
});

rl.on('line', (line) => {
  console.log('Nível da aproximação:', ((line * 100) / 138).toFixed(2));

  
  // Objeto para representar os dados recebidos
  const data = {
    timestamp: new Date().toISOString().replace(/T/, '  ').replace(/\..+/, ' '), // Formata o timestamp para exibir apenas data e hora
    value: line.trim() // Remove espaços em branco extras e atribui o valor recebido
  };

  // Converte o objeto em formato JSON
  const jsonData = JSON.stringify(data);

  // Nome do arquivo para salvar os dados (pode ser ajustado conforme necessário)
  const filename = 'dados.json';

  // Adiciona os dados ao arquivo JSON
  fs.appendFile(filename, jsonData + '\n', (err) => {
    if (err) {
      console.error('Erro ao gravar no arquivo:', err);
    } else {
      console.log('Dados gravados com sucesso!');
      // Chame a função para inserir os dados do arquivo JSON no banco de dados
      inserirDadosDoJson(filename);
    }
  });
});
