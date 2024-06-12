<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitore a Bomba D'água</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            text-align: center;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .inputBox {
            position: relative;
            margin-bottom: 25px;
        }

        .inputUser {
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

        .labelInput {
            position: absolute;
            top: 10px;
            left: 0;
            font-size: 15px;
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
        }

        .inputUser:focus + .labelInput,
        .inputUser:valid + .labelInput {
            top: -10px;
            font-size: 12px;
            color: white;
        }

        .inputSubmit {
            background-color: #2980b9;
            width: 100%;
            border: none;
            padding: 12px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .inputSubmit:hover {
            background-color: rgb(130, 130, 255);
        }

    .logo {
    max-width: 70%;
    margin-bottom: 20px; 
    box-shadow(1px 1px 20px blue)
    filter: drop-shadow(1px 1px 20px, blue);
        }

    </style>
</head>
<body>
<div class="container">
    <!-- Adicionando a imagem -->
<img src="imagens/logo6.png" alt="Logo" class="logo">
    <form action="login_teste.php" method="POST">
        <div class="inputBox">
            <input type="text" name="email" id="email" class="inputUser" required>
            <label for="email" class="labelInput">Email</label>
        </div>
        <div class="inputBox">
            <input type="password" name="senha" id="senha" class="inputUser" required>
            <label for="senha" class="labelInput">Senha</label>
        </div>
        <input class="inputSubmit" type="submit" name="submit" value="Entrar">
        <?php
        session_start();
        if(isset($_SESSION['error_message'])) {
            echo '<p>' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']);
        }
        ?>
    </form>
</div>
</body>
</html>
