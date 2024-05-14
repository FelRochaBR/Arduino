<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .dashboard {
            display: flex;
            height: 100vh;
        }
        .options {
            width: 200px;
            background-color: #333;
            color: #fff;
            padding: 20px;
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
        .container {
            flex: 1; /* Ocupa todo o espaço restante */
            padding: 100px; /* Ajuste o preenchimento conforme necessário */
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            margin: 100px; /* Espaçamento entre o container e a borda da tela */
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="options">
            <ul>
                <li><a href="#">Gráfico</a></li>
                <li><a href="#">Calendário</a></li>
                <li><a href="#">Configurações</a></li>
                <li><a href="#">Informações</a></li>
                <li><a href="introducao.php">Sair</a></li>
            </ul>
        </div>
        <div class="container">
            <!-- Conteúdo da dashboard vai aqui -->
            <h2>Bem-vindo à Dashboard</h2>
            <p>Selecione uma opção no painel à esquerda.</p>
        </div>
    </div>
</body>
</html>
