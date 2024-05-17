<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efeito Tridimensional</title>
    <style>
        .container {
            width: 300px;
            height: 200px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .container::before {
            content: "";
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.8), transparent);
            z-index: -1;
        }

        .container::after {
            content: "";
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8), transparent);
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Seu conteúdo aqui -->
    </div>
</body>
</html>

