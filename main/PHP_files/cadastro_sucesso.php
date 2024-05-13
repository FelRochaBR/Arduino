<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário Cadastrado</title>
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
    <div class="container">
        <h2>Usuário Cadastrado</h2>
        <p>O usuário foi cadastrado com sucesso!</p>
        <a href="introducao.php" class="back-link">&laquo; Voltar</a>
    </div>
</body>
</html>
