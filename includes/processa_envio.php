<?php
    // realiza a importação da Classe Mensagem
    require_once 'Mensagem/Mensagem.php'; 

    //Importando arquivos do PHPMailer
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/Exception.php';
    require_once 'PHPMailer/SMTP.php';

    //Importando as Classes do PHPMailer dentro dos NameSpaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Instanciando o objeto de Mensagem
    $oMsg = new Mensagem($_POST['email'], $_POST['assunto'], $_POST['mensagem']);

    // Instanciando o objeto PhpMailer
    $oMail = new PHPMailer(true);

    if ( ! $oMsg->msgValida() ) {
        echo 'Mensagem Inválida.';
        die();
    }

    try {
        //Configurações do servidor SMTP
        //$oMail->SMTPDebug = SMTP::DEBUG_SERVER;                         // Habilitando Verbose para debug
        $oMail->isSMTP();                                               // Denfinindo Protocolo SMTP
        $oMail->Host       = 'smtp.servidor.com';                       // Definindo enderenço do servidor
        $oMail->SMTPAuth   = true;                                      // Habilitando autenticação
        $oMail->Username   = 'usuario@servidor.com';                    // Usuário SMTP 
        $oMail->Password   = 'SENHA123';                                // Senha SMTP
        $oMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Habilitando TLS
        $oMail->Port       = 587;                                       // Definindo a porta

        //Linguagem e Codificação
        $mail->setLanguage('br');
        $mail->CharSet = 'UTF-8';

        //Destinatários
        $oMail->setFrom('felipe.j.darocha05@gmail.com', 'Felipe Junio'); // Deifinindo o E-mail de origem
        $oMail->addAddress($oMsg->getPara());                            // Definindo o E-mail de Destino

        //Conteudo
        $oMail->isHTML(true);                                            // Definindo o formato do e-mail em HTML
        $oMail->Subject =  $oMsg->getAssunto();                          // Define o assunto
        $oMail->Body    = $oMsg->getMsg();                               // Define a mensagem com suporte a HTML
        $oMail->AltBody = '';                                            // Define a mensagem sem suporte a HTML

        //Enviando mensagem
        $oMail->send();                                                  // envia o e-mail
        echo 'Mensagem enviada com sucesso';

    } catch (Exception $e) {
        echo 'A mensagem não pode ser enviada, tente novamente mais tarde...';
        echo "Erro: {$oMail->ErrorInfo}";
    }
?>