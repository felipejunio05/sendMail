<?php
    // realiza a importação da Classe Mensagem
    require_once 'Mensagem/Mensagem.php'; 

    // Retorna para página principal com parâmetro de erro = 1, caso o acesso tenha sido indevido.
    if ( !isset($_POST['email'], $_POST['assunto'], $_POST['mensagem']) ) {
        header('Location: index.php?erro=1');
        die("Acesso indevido ao conteudo.");

    } else {
        // Instanciando o objeto de Mensagem
        $oMsg = new Mensagem($_POST['email'], $_POST['assunto'], $_POST['mensagem']);

        // Retorna para página principal com parâmetro de erro = 2, caso o conteúdo da mensagem seja inválido .
        if ( ! $oMsg->msgValida() ) {
            header('Location: index.php?erro=2');
            die("A mensagem não é valida.");
        }
    }

    //Importando arquivos do PHPMailer
    require_once 'PHPMailer/PHPMailer.php';
    require_once 'PHPMailer/Exception.php';
    require_once 'PHPMailer/SMTP.php';

    //Importando as Classes do PHPMailer dentro dos NameSpaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Instanciando o objeto PhpMailer
    $oMail = new PHPMailer(true);

    try {
        //Configurações do servidor SMTP
        $oMail->SMTPDebug = false;                                      // Desabilitando o modo Verboso
        $oMail->isSMTP();                                               // Denfinindo Protocolo SMTP
        $oMail->Host       = 'smtp.exemplo.com';                        // Definindo enderenço do servidor
        $oMail->SMTPAuth   = true;                                      // Habilitando autenticação
        $oMail->Username   = 'usuario@exemplo.com';                     // Usuário SMTP 
        $oMail->Password   = 'SENHA123';                                // Senha SMTP
        $oMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            // Habilitando TLS
        $oMail->Port       = 587;                                       // Definindo a porta

        //Linguagem e Codificação
        $oMail->setLanguage('br');
        $oMail->CharSet = 'UTF-8';

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
        $oMsg->setStatus('1','Mensagem enviada com sucesso');            // define o status da mensagem

    } catch (Exception $e) {
        $oMsg->setStatus('2', 'A mensagem não pode ser enviada, tente novamente mais tarde... <br> Erro: ' . $oMail->ErrorInfo);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

		<!--CSS Bootstrap-->
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">  
			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="img/logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>

            <div class="row" >
                <div class="col-md-12">
                    <? if ( $oMsg->getStatus()['id'] === 1 ) { ?>
                        <div class="container">
                            <h1 class="display-4 text-success">Sucesso</h1>
                            <p><?= $oMsg->getStatus()['msg'] ?></p>
                            <a href="index.php" class="btn btn-success btn-lg mt-3 text-white">Voltar</a>
                        </div>
                    <? } else { ?>
                        <div class="container">
                            <h1 class="display-4 mb-3 text-danger">Ops!</h1>
                            <p><?= $oMsg->getStatus()['msg'] ?></p>
                            <a href="index.php" class="btn btn-danger btn-lg mt-3 text-white">Voltar</a>
                        <div>
                    <? } ?>
                <div>
            <div>
        </div>
    </body>
</html>