<?php

namespace core\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EnviarEmail{

    public function EmailConfirmacaoCliente($email_cliente, $nome_usuario, $link){

        $mail = new PHPMailer(true);


        $link = BASE_URL . '?a=confirmar_email&token=' . $link;
        try {
            //Server settings
            
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient              //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Confirmação de E-mail.';
            $html = '<p>Olá <strong>'. ucfirst(strtolower($nome_usuario)) .'!</strong>,</p>
            <p>Bem-vindo(a) à <strong>' . APP_NAME . '</strong>! </p>
            <p>Estamos quase lá. Para concluir o seu registro e garantir a segurança da sua conta, confirme o seu endereço de e-mail clicando no botão abaixo.</p>
            <a href="'. $link.'">Clique Aqui</a>';

            $mail->Body    = $html;
    

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }


    }

    public function EmailFormularioDuvidas($tipo_produto, $nome_cliente, $email_cliente, $duvida){

        $mail = new PHPMailer(true);

        try {
            //Server settings
            
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress(EMAIL_FROM);


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Cliente: ' .$nome_cliente . ' - Possuo uma dúvida.';
            $html = '<p>Nome do cliente: '.$nome_cliente.'</p>
            <p>E-mail do cliente: '.$email_cliente.'</p>
            <p>Duvida referente á: '.$tipo_produto.'</p>
            <p>Dúvida: '.$duvida.'</p>';

            $mail->Body    = $html;
    

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }


    }

    public function EmailResposta($tipo_produto, $nome_cliente, $email_cliente){

        $mail = new PHPMailer(true);

        try {
            //Server settings
            
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Recebemos sua dúvida!';
            $html = '<p>Olá <strong>'. ucfirst(strtolower($nome_cliente)) .'!</strong>,</p>
            <p>Estamos enviando este e-mail para confirmar que recebemos sua referente á '.$tipo_produto.'.</p>
            <p>Nossa equipe entrará em contato para responder sua dúvida o mais breve possível!</p><br>
            <p>Atenciosamente,</p>
            <i><small>'.APP_NAME.'</small></i>';

            $mail->Body    = $html;
    

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }


    }
}




