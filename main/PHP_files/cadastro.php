<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, #3E5151, #3E5151);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container{
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
            color: white;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .inputBox{
            margin-bottom: 20px;
        }

        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            padding: 10px 0;
            letter-spacing: 2px;
        }

        .inputUser:focus {
            border-bottom: 1px solid rgb(130, 130, 255);
        }

        .labelInput{
            font-size: 12px;
            color: rgb(130, 130, 255);
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .radioGroup {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between; /* Adicionando espaço entre os botões */
        }

        .radioGroup label {
            background-color: #747575;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            flex: 1;
            margin-right: 10px; /* Espaçamento entre os botões */
        }

        .radioGroup label:last-child {
            margin-right: 0; /* Remover margem direita do último botão */
        }

        .radioGroup label:hover {
            background-color: gray;
        }

        .radioGroup input[type="radio"] {
            display: none;
        }

        .radioGroup input[type="radio"]:checked + label {
            background-color: rgb(130, 130, 255);
        }

        #submit{
            background-color: #747575;
            width: 100%;
            border: none;
            padding: 10px;
            color: white;
            font-size: 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        #submit:hover{
            background-color: #2980b9;
        }

        .back-link {
            color: white;
            text-decoration: none;
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <a href="introducao.php" class="back-link">Voltar</a>
    <div class="container">
        <form action="" method="POST">
            <div class="inputBox">
                <label for="nome" class="labelInput">Nome completo</label>
                <input type="text" name="nome" id="nome" class="inputUser" required>
            </div>
            
            <div class="inputBox">
                <label for="email" class="labelInput">Email</label>
                <input type="email" name="email" id="email" class="inputUser" required>
            </div>

            <div class="inputBox">
                <label for="numero_cel" class="labelInput">Número de Celular</label>
                <input type="text" name="numero_cel" id="numero_cel" class="inputUser" required>
            </div>

            <div class="inputBox">
                <label for="cpf" class="labelInput">CPF</label>
                <input type="text" name="cpf" id="cpf" class="inputUser" required>
            </div>
            
            <div class="inputBox">
                <label for="senha" class="labelInput">Senha</label>
                <input type="password" name="senha" id="senha" class="inputUser" required>
            </div>
            
            <div class="radioGroup">
                <input type="radio" id="admin" name="cargo" value="admin" required>
                <label for="admin">Administrador</label>
                
                <input type="radio" id="usuario" name="cargo" value="usuario" required>
                <label for="usuario">Usuário</label>
            </div>
        
            <input type="submit" name="submit" id="submit" value="Cadastrar">
        </form>
    </div>

    <script>
        // Adiciona "55" automaticamente ao número de celular
        document.getElementById('numero_cel').addEventListener('input', function (e) {
            var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });

        // Adiciona máscara ao CPF
        document.getElementById('cpf').addEventListener('input', function (e) {
            var cpf = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
            e.target.value = !cpf[2] ? cpf[1] : cpf[1] + '.' + cpf[2] + (cpf[3] ? '.' + cpf[3] : '') + (cpf[4] ? '-' + cpf[4] : '');
        });

        // Verifica se o e-mail é válido
        document.getElementById('email').addEventListener('input', function (e) {
            var email = e.target.value;
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var isValid = regex.test(email);
            e.target.setCustomValidity(isValid ? '' : 'Digite um e-mail válido');
        });

        // Adiciona máscara ao número de telefone
        document.getElementById('numero_cel').addEventListener('input', function (e) {
            var tel = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !tel[2] ? tel[1] : '(' + tel[1] + ') ' + tel[2] + (tel[3] ? '-' + tel[3] : '');
        });
    </script>
    <?php
if(isset($_POST['submit'])){
    include_once('config.php');
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $numero_cel = $_POST['numero_cel'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo'];

    // Verificar se o email já existe
    $check_email = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        echo "<script>alert('Erro: E-mail já cadastrado!'); window.location.href='cadastro.php';</script>";
    } else {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir os dados na tabela
        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, numero_cel, cpf, senha, cargo) VALUES ('$nome', '$email', '$numero_cel', '$cpf', '$senha_hash', '$cargo')");

        if ($result) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login_teste.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar. Tente novamente.'); window.location.href='cadastro.php';</script>";
        }
    }
}
?>

</body>
</html>