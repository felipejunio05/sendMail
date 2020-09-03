<!DOCTYPE html>

<html lang="pt-BR">
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

		<!--FontAwesome CSS-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
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

      		<div class="row">
      			<div class="col-md-12">
					<div class="card-body font-weight-bold">
						<form action="processa_envio.php" method="post">
							<div class="form-group">
								<label for="para">Para</label>
								<input name="email" type="text" class="form-control" id="para" placeholder="joao@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea name="mensagem" class="form-control" id="mensagem"></textarea>
							</div>

							<? if ( isset($_GET['erro']) ) { ?>
								<? if ( $_GET['erro'] == 1 ) { ?>
									<div class="text-danger pb-2">
										<i class="fas fa-exclamation-triangle"></i>
										Acesso indevido!
									</div>
								<? } elseif ( $_GET['erro'] == 2 ) {?>
									<div class="text-danger pb-2">
										<i class="fas fa-info-circle"></i>
										Todos os campos devem ser preenchidos
									</div>
								<? } ?>
							<? } ?>
							<button type="submit" class="btn btn-primary btn-lg">Enviar Mensagem</button>
						</form>
					</div>
				</div>
      		</div>
      	</div>
	</body>
</html>