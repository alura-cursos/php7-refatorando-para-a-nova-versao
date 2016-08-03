<?php
$usuario = $viewBag["usuario"];
$usuarioLogado = $viewBag["usuarioLogado"];
$postagens = $viewBag["postagens"];
$postsPorSemana = $viewBag["postsPorSemana"];

use Vendor\Model\Login;

?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $usuario->getNome()?>!</title>
	<link rel="stylesheet" href="Vendor/View/CSS/reset.css">
	<link rel="stylesheet" href="Vendor/View/CSS/postagem-index.css">
</head>
<body>
	<header class="logado">
	<?php 

		if(!isset($_SESSION["usuario_logado"])){
	?>
			<a href="/miniblog">Miniblog!</a>
	<?php
		}
		else{
	?>
			<a href="index.php?c=Index&m=index&usuarioId=<?= $usuarioLogado->getId(); ?>">
				Home
			</a>
	<?php
		}
	?>
	</header>
	<section class="profile-header">
		<p class="nome"> <?= $usuario->getNome(); ?>	</p>
		<p class="bio"> <?= $usuario->getBio(); ?>	</p>
		<p>posts por semana: <?= $postsPorSemana ;?></p>
	</section>
	<section class="timeline-content visita-timeline container">
			<ul class="post">
			<?php
				foreach ($postagens as $post){
			?>
					<li>
						<div class="post-header">
							<p> <?= $usuario->getNome(); ?>	</p>
							<p> <?= $post->getData(); ?>	</p>
						</div>
						<p><?= $post->getConteudo(); ?></p>	
					</li>
			<?php 
				}
			?>
			</ul>
	</section>
</body>
</html>