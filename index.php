<?php
	if (isset($_POST['post'])) {

		$url = "https://www.google.com/recaptcha/api/siteverify";
		$data = [
			'secret' => "6LetMeQZAAAAAIuZnIzYFBj2ldd6hHSatcRB_EHn",
			'response' => $_POST['token'],
			'remoteip' => $_SERVER['REMOTE_ADDR']
		];

		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data)
			)
		);

		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);

		$res = json_decode($response, true);
		if($res['success'] == true) {

  			echo '<div id="enviado" class="aviso">
			  		Formulário enviado com sucesso.
		 		  </div>';
		} 
		else {
			echo '<div id="Falha" class="aviso">
					  Falha no Captcha.
				  </div>';
		}
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Captcha</title>
	 <script src="https://www.google.com/recaptcha/api.js?render=6LetMeQZAAAAANok7j9-dlF2KGqYOjO1_nabNxh4"></script>
	 <style>

	 	body{
	 		background-color: #EEE;
	 		color: #066a75;
	 		font-family: Calibri;
	 		margin: 0;
	 		padding: 0;
	 	}

	 	h1{ text-align: center; }
	 	hr{	border: solid 1px #3D9DB3; }
	 	form{ margin-top: 20px }

	 	.container {
			width: 100%;
			height: 90vh;
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center
		}

		.campo{
			border: 1px solid #C2C2C2;
			border-radius: 3px;
			box-shadow: 1px 1px 4px #EBEBEB;
			box-sizing: border-box;
			margin-bottom: 20px;
			padding: 5px;
			outline: none;
	 	}

	 	.aviso{
	 	 	color: white;
	 	 	font-weight: bold;
	 	 	padding: 10px;
	 	}

	 	#f-login{
	 		background-color: #F6F6F6;
	 		border: solid 1px #3D9DB3;
	 		border-radius: 5px;
	 		display: inline-block;
	 		padding: 5px 20px;
	 	}

	 	#btn{
	 		background-color: #3D9DB3;
	 		border: none;
	 		border-radius: 5px;
	 		box-shadow: none;
	 		color: white;
	 		cursor: pointer;
	 		display: block;
	 		margin-top: 20px;
	 		padding: 10px;
	 		width: 100%;
	 	 }

	 	 #falha{ background-color: #fa8181; }
	 	 #enviado{ background-color: #91ce76; }

	 </style>
</head>
<body>
	<div class="container">
		<div id="f-login">
			<h1>Login</h1>
			<hr>
			<form method="POST">
				<label for="usuario">
					Nome de Usuário:<br>
					<input type="text" name="usuario" class="campo" size="60" required>
				</label>
				<br>
				<label for="senha">
					Senha:<br>
					<input type="password" name="senha" class="campo" size="60" required>
				</label>
				
				<div class="form-group">
					<input type="submit" name="post" value="Entrar" class="btn btn-success btn-block" id="btn">
				</div>
				
				<br>
				<input type="hidden" name="token" id="token">
			</form>
		</div>
	</div>
</body>

<script>
  grecaptcha.ready(function() {
      grecaptcha.execute('6LetMeQZAAAAANok7j9-dlF2KGqYOjO1_nabNxh4', {action: 'homepage'}).then(function(token) {
         document.getElementById("token").value = token;
      });
  });
</script>

</html>