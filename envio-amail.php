<?php

//requerimento das bibliotecas e arquivos necessários para o envio ser executado
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);


//requerimentos do formulario (dados adquiridos do formulário)
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $mensagem = $_POST['message']; 
}

try{

    //modo debug 
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->isSMTP();

    //servidor de email
    $mail->Host ='smtp.gmail.com';

    $mail->SMTPAuth  = true;

    //email remetente (que fará o envio)
    $mail->Username = 'samukakaroto123@gmail.com';
    
    //senha de app necessária para autenticação no servidor 
    $mail->Password = '1234 1234 1234 1234'; 
    
    //porta usada pelo servidor do gmail 
    $mail->Port = 587;

    //esse email precisa necessáriamente  ser o mesmo Username
    $mail->setFrom('samukakaroto123@gmail.com'); 
    
    //esse será o email que receberá a mensagen configurada
    $mail->addAddress($email);

    $mail->isHTML(true);

    //assunto do email
    $mail->Subject = 'Email de ' .$nome;

    //corpo do email mensagen em si
    $mail->Body = $mensagem. '<br> O numero do(a) ' .$nome.' é: '.$numero;

    if ($mail->send()) {
        echo 'Email enviado com sucesso';
    }
    else {
        echo 'Email nao enviado';
    }
    

}
catch (Exception $e){
    echo "Erro ao enviar email:{$mail->ErrorInfo}";
}

?>