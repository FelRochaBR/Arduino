<?php

require 'vendor/autoload.php'; // Faça o download e instale a biblioteca SendGrid com composer

$email = $_POST['email']; // Supondo que o email foi enviado pelo formulário HTML

$from = new \SendGrid\Mail\Mail("Your Name", "your_email@example.com"); // Seu nome e e-mail
$subject = "Recuperação de Senha";
$to = new \SendGrid\Mail\To(null, $email); // E-mail do destinatário
$htmlContent = "<strong>Olá!</strong><br><p>Clique no link abaixo para redefinir sua senha.</p>"; // Conteúdo HTML do e-mail
$from->setSubject($subject);
$from->addTo($to);
$from->addContent("text/html", $htmlContent);

$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY')); // Obtenha a chave da API SendGrid
try {
    $response = $sendgrid->send($from);
    echo "E-mail enviado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: {$e->getMessage()}";
}
