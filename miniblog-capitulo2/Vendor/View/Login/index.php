<?php 
	
	if(!isset($viewBag['error'])){
	$error = '';
	}
	else{
	$error = $viewBag['error'];
	}
	if(!isset($viewBag['register'])){
	$register = '';
	}
	else{
	$register = $viewBag['register'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
        <link rel="stylesheet" href="Vendor/View/CSS/login-index.css">
  </head>
<body>
	<section class="form-module login">
	  <div class="form">
	    <h2>Entre no seu mini-blog!</h2>
	    <form method="POST" action="index.php?c=Login&m=login">
	      <input type="email" name="email" placeholder="Email"/>
	      <input type="password" name="senha" placeholder="Senha"/>
	      <button type="submit">Entrar</button>
	      <?= $error ?>
	    </form>
	   </div>
	  </section>
	<section class="form-module sign-in">
		<div class="form">
			<h2>Não é registrado? Registre-se agora!</h2>
			<form method="POST" action="index.php?c=Login&m=register">
		      <input type="email" name="email" placeholder="*Email"/>
		      <input type="text" name="nome" placeholder="*Nome"/>
		      <input type="password" name="senha" placeholder="*Senha"/>
		      <textarea class="bio" maxlength="160" name="bio" placeholder="Fale um pouco sobre você"></textarea>
		      <button type="submit">Registrar</button>
		      <?= $register ?>
		    </form>
		</div>
	</section>
  </body>
</html>