<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração do Administrador</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-info div {
            margin: 10px 0;
            width: 100%;
        }

        .user-info label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .user-info input {
            width: calc(100% - 22px);
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #f0f0f0;
            color: #2c3e50;
        }

        .user-info input[disabled] {
            background-color: #ccc;
        }

        .menu {
            text-align: center;
        }

        .menu a {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
            background-color: #747575;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .menu a:hover {
            background-color: #2980b9;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #1d6fa5;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Configurações do Administrador</h1>
        </div>
        <div class="user-info">
            <div>
                <label for="user-id">ID</label>
                <input type="text" id="user-id" disabled>
            </div>
            <div>
                <label for="user-name">Nome</label>
                <input type="text" id="user-name" disabled>
            </div>
            <div>
                <label for="user-email">Email</label>
                <input type="email" id="user-email" disabled>
            </div>
            <div>
                <label for="user-password">Senha</label>
                <input type="password" id="user-password" value="****" disabled>
            </div>
            <div>
                <label for="user-role">Cargo</label>
                <input type="text" id="user-role" disabled>
            </div>
            <div>
                <label for="user-cpf">CPF</label>
                <input type="text" id="user-cpf" disabled>
            </div>
            <div>
                <label for="user-phone">Número Celular</label>
                <input type="text" id="user-phone" disabled>
            </div>
            <button class="btn-edit" onclick="toggleEdit(this)">Editar</button>
        </div>
        <div class="menu">
            <a href="cadastro.php">Cadastrar Usuário</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('get_user_data.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user-id').value = data.id;
                    document.getElementById('user-name').value = data.nome;
                    document.getElementById('user-email').value = data.email;
                    document.getElementById('user-password').value = '****';
                    document.getElementById('user-role').value = data.cargo;
                    document.getElementById('user-cpf').value = data.cpf;
                    document.getElementById('user-phone').value = data.numero_cel;
                });
        });

        function toggleEdit(button) {
            const inputs = document.querySelectorAll('.user-info input');
            const isEditing = inputs[0].disabled === false;

            inputs.forEach(input => {
                input.disabled = !isEditing;
            });

            if (isEditing) {
                button.innerText = 'Editar';
                button.classList.remove('btn-save');
                button.classList.add('btn-edit');
                // Aqui você pode adicionar uma função para salvar os dados alterados
            } else {
                button.innerText = 'Salvar';
                button.classList.remove('btn-edit');
                button.classList.add('btn-save');
            }
        }
    </script>
</body>
</html>
