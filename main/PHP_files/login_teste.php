<?php
session_start();

if(isset($_POST['submit'])){
    // Verifica se todos os campos foram preenchidos
    if(empty($_POST['email']) || empty($_POST['senha'])) {
        $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
        header('Location: introducao.php');
        exit();
    }

    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o e-mail é válido
    $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
    if (!preg_match($emailRegex, $email)) {
        $_SESSION['error_message'] = 'Por favor, insira um e-mail válido.';
        header('Location: introducao.php');
        exit();
    }

    $sql= "SELECT * FROM usuarios WHERE email = '$email'";

    $result = $conexao->query($sql);

    if(mysqli_num_rows($result) < 1){
        $_SESSION['error_message'] = 'Email não encontrado.';
        header('Location: introducao.php');
        exit();
    }
    else{
        $row = $result->fetch_assoc();
        if(password_verify($senha, $row['senha'])){
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: sistema.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Senha incorreta.';
            header('Location: introducao.php');
            exit();
        }
    }
}
else{
    $_SESSION['error_message'] = 'Preencha todos os campos.';
    header('Location: introducao.php');
    exit();
}
?>
