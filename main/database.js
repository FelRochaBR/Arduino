const fs = require('fs');
const mysql = require('mysql');

// Crie uma conexão com o banco de dados MySQL
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'acelera2024'
});

// Mantenha a conexão com o banco de dados aberta
connection.connect((err) => {
  if (err) {
    console.error('Erro ao conectar ao banco de dados:', err);
    return;
  }
  console.log('Conexão com o banco de dados MySQL estabelecida');
});

// Função para inserir os dados do arquivo JSON no banco de dados
function inserirDadosDoJson(filename) {
  // Leia o arquivo JSON
  fs.readFile(filename, 'utf8', (err, data) => {
    if (err) {
      console.error('Erro ao ler o arquivo JSON:', err);
      return;
    }

    try {
      const dados = data.trim().split('\n').map(line => JSON.parse(line));

      const query = 'INSERT INTO leituras_nivel_agua (timestamp, valor) VALUES (?, ?)';
      
      dados.forEach((item) => {
        const values = [item.timestamp, item.value];
        connection.query(query, values, (error, results, fields) => {
          if (error) {
            console.error('Erro ao inserir dados:', error);
          } else {
            console.log('Dados inseridos com sucesso no Banco MySql!');
          }
        });
      });
    } catch (error) {
      console.error('Erro ao analisar o arquivo JSON:', error);
    }
  });
}

module.exports = { inserirDadosDoJson };
