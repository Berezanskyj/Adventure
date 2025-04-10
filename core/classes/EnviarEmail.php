<?php

namespace core\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EnviarEmail
{

    public function EmailConfirmacaoCliente($email_cliente, $nome_usuario, $link)
    {

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
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = 'UTF-8';                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient              //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Confirmação de E-mail.';
            $html = '<p>Olá <strong>' . ucfirst(strtolower($nome_usuario)) . '!</strong>,</p>
            <p>Bem-vindo(a) à <strong>' . APP_NAME . '</strong>! </p>
            <p>Estamos quase lá. Para concluir o seu registro e garantir a segurança da sua conta, confirme o seu endereço de e-mail clicando no botão abaixo.</p>
            <a href="' . $link . '">Clique Aqui</a>';

            $mail->Body    = $html;


            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function EmailFormularioDuvidas($tipo_produto, $nome_cliente, $email_cliente, $duvida)
    {

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
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = 'UTF-8';                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress(EMAIL_FROM);


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Cliente: ' . $nome_cliente . ' - Possuo uma dúvida.';
            $html = '<p>Nome do cliente: ' . $nome_cliente . '</p>
            <p>E-mail do cliente: ' . $email_cliente . '</p>
            <p>Duvida referente á: ' . $tipo_produto . '</p>
            <p>Dúvida: ' . $duvida . '</p>';

            $mail->Body    = $html;


            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function EmailResposta($tipo_produto, $nome_cliente, $email_cliente)
    {

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
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = 'UTF-8';                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Recebemos sua dúvida!';
            $html = '<p>Olá <strong>' . ucfirst(strtolower($nome_cliente)) . '!</strong>,</p>
            <p>Estamos enviando este e-mail para confirmar que recebemos sua referente á ' . $tipo_produto . '.</p>
            <p>Nossa equipe entrará em contato para responder sua dúvida o mais breve possível!</p><br>
            <p>Atenciosamente,</p>
            <i><small>' . APP_NAME . '</small></i>';

            $mail->Body    = $html;


            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function EmailRecuperarSenha($email_cliente)
    {

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
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = 'UTF-8';                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Recuperação de senha';
            $html = '<p>Olá!</p>
            <p>Informamos que a senha da sua conta foi alterada com sucesso. Abaixo estão os detalhes:</p>
            <p><strong>E-mail da conta:</strong> ' . $email_cliente . '</p>
            <p>Se você realizou essa alteração, nenhuma ação adicional é necessária.</p>
            <p><strong>Importante:</strong> Se você não solicitou a troca de senha, por favor, entre em contato imediatamente com nosso suporte para garantir a segurança da sua conta.</p>
            <p>Agradecemos por utilizar nossos serviços.</p>
            <i><small>' . APP_NAME . '</small></i>';

            $mail->Body    = $html;


            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function enviarEmailProdutos(
        $nome_usuario,
        $status_pedido,
        $status_pagamento,
        $mensagem_administrador,
        $email_cliente,
        $produtos,
        $pedidoID,
        $metodo_pagamento,
        $dataPedido,
        $totalPedido,
        $arquivo = null // Receber o anexo aqui
    ) {
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = EMAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_FROM;
            $mail->Password   = EMAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = 'UTF-8';

            // Configuração do remetente e destinatário
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);

            // Anexar arquivo, se existir
            if (!empty($arquivo)) {
                $arquivoTemp = $arquivo['tmp_name'];
                $nomeArquivo = basename($arquivo['name']);
                $mail->addAttachment($arquivoTemp, $nomeArquivo);
            }

            // Montar a tabela de produtos
            $produtos_html = '';
            foreach ($produtos as $produto) {
                $produtos_html .= '
                        <tr style="text-align: center;">
                            <td>' . htmlspecialchars($produto->item_id) . '</td>
                            <td>' . htmlspecialchars($produto->produto_nome) . '</td>
                            <td>R$ ' . htmlspecialchars($produto->preco_unitario) . '</td>
                            <td>' . htmlspecialchars($produto->quantidade) . '</td>
                        </tr>';
            }

            // Montar o HTML do e-mail
            $html = '
                        <html>
                            <head>
                                <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        margin: 0;
                                        padding: 0;
                                        background-color: #f4f4f4;
                                        color: #333333;
                                    }
                                    .container {
                                        width: 100%;
                                        max-width: 600px;
                                        margin: 0 auto;
                                        background-color: #ffffff;
                                        border-radius: 8px;
                                        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                                        padding: 20px;
                                        text-align: center;
                                    }
                                    h2 {
                                        color: #333333;
                                        font-size: 24px;
                                        margin-bottom: 20px;
                                    }
                                    p {
                                        color: #666666;
                                        font-size: 14px;
                                        line-height: 1.6;
                                    }
                                    .table-container {
                                        margin: 20px 0;
                                        width: 100%;
                                        border-collapse: collapse;
                                    }
                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-bottom: 20px;
                                    }
                                    th, td {
                                        padding: 12px;
                                        text-align: center;
                                        border: 1px solid #ddd;
                                    }
                                    th {
                                        background-color: #6E7881;
                                        color: white;
                                    }
                                    td {
                                        background-color: #f9f9f9;
                                    }
                                    .footer {
                                        margin-top: 20px;
                                        font-size: 14px;
                                        color: #666666;
                                        text-align: center;
                                    }
                                    .footer a {
                                        color: #6E7881;
                                        text-decoration: none;
                                    }
                                    .footer p {
                                        margin-top: 10px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class="container">
                                    <h2>Atualização do Pedido</h2>
                                    <p>Olá, <strong>' . $nome_usuario . '!</strong></p>
                                    <p><strong>Status do seu pedido:</strong> ' . $status_pedido . '</p>
                                    <p><strong>Metodo de pagamento:</strong> ' . $metodo_pagamento . '</p>
                                    <p><strong>Status de pagamento:</strong> ' . $status_pagamento . '</p>
                                    <p><strong>Data do pedido:</strong> ' . $dataPedido . '</p>
                                    <p><strong>Total do pedido: </strong> ' . $totalPedido . '</p>
                                    <p><strong>Mensagem do administrador:</strong><br>' . nl2br(htmlspecialchars($mensagem_administrador)) . '</p>
        
                                    <p style="color: #333333;">Seu pedido foi atualizado. Abaixo estão os detalhes do pedido:</p>
        
                                    <div class="table-container">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Produto</th>
                                                    <th>Preço (R$)</th>
                                                    <th>Quantidade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ' . $produtos_html . '
                                            </tbody>
                                        </table>
                                    </div>
        
                                    <p>Caso tenha dúvidas, entre em contato com nosso <a href="mailto:support@empresa.com">suporte</a>.</p>
        
                                    <div class="footer">
                                        <p>Agradecemos por utilizar nossos serviços!</p>
                                        <p>Atenciosamente,<br><strong>Equipe Adventure</strong></p>
                                    </div>
                                </div>
                            </body>
                        </html>';

            // Configuração do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Pedido #' . $pedidoID . ' - Atualização do pedido';
            $mail->Body    = $html;

            // Enviar e-mail
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
