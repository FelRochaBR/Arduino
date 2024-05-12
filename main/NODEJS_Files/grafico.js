// Função para carregar o arquivo JSON
async function carregarJSON() {
    try {
      const resposta = await fetch('dados.json');
      const dadosJson = await resposta.text();
      return dadosJson;
    } catch (erro) {
      console.error('Erro ao carregar o arquivo JSON:', erro);
    }
  }
  
  // Função para processar os dados e criar o gráfico
  async function criarGrafico() {
    const dadosJson = await carregarJSON();
  
    // Converter o JSON em um array de objetos
    const dados = dadosJson.split('\n').map(line => JSON.parse(line));
  
    // Extrair timestamps e valores
    const timestamps = dados.map(dado => new Date(dado.timestamp));
    const valores = dados.map(dado => parseFloat(dado.value));
  
    // Atualizar o gráfico com os novos dados
    const ctx = document.getElementById('meuGrafico');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: timestamps,
        datasets: [{
          label: 'Serial',
          data: valores,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }
  
  // Chamar a função para criar o gráfico quando a página estiver carregada
  document.addEventListener('DOMContentLoaded', criarGrafico);
  