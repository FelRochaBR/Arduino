<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Acesso à Conta</title>
    <style>
        body{ 
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
            position: absolute;
            top: 30%;
            right: 15%;
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

        .voltar {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .voltar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Recuperar Acesso à Conta</h2>
    <form action="recuperar_acesso.php" method="POST">
        <div class="inputBox">
            <input type="text" name="email" id="email" class="inputUser" required>
            <label for="email" class="labelInput">Email</label>
        </div>
        <input class="inputSubmit" type="submit" name="submit" value="Recuperar Acesso">
    </form>
    <br>
    <a href="introducao.php" class="voltar">Voltar para o login</a>
</div>
</body>
</html>
