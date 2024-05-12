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
      // Divida os dados em linhas
      const linhas = data.trim().split('\n');

      // Consulta para contar as linhas já inseridas
      const countQuery = 'SELECT COUNT(*) as count FROM leituras_nivel_agua';

      // Consulta para inserir os dados
      const insertQuery = 'INSERT INTO leituras_nivel_agua (timestamp, valor) VALUES (?, ?)';

      // Obter o número de linhas já inseridas
      connection.query(countQuery, (error, results) => {
        if (error) {
          console.error('Erro ao contar as linhas já inseridas:', error);
          return;
        }

        const linhasInseridas = results[0].count;

        // Itere sobre cada linha a partir da última linha inserida
        for (let i = linhasInseridas; i < linhas.length; i++) {
          try {
            // Parseie a linha como JSON
            const item = JSON.parse(linhas[i]);

            // Executar a consulta SQL para inserir os dados
            connection.query(insertQuery, [item.timestamp, item.value], (error, results, fields) => {
              if (error) {
                console.error('Erro ao inserir dados:', error);
              } else {
                console.log('Dado inserido com sucesso no Banco MySql:', item);
              }
            });
          } catch (error) {
            console.error('Erro ao analisar a linha como JSON:', error);
          }
        }
      });
    } catch (error) {
      console.error('Erro ao analisar o arquivo JSON:', error);
    }
  });
}

module.exports = { inserirDadosDoJson };
