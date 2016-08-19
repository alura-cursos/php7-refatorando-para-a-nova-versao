<?php
$usuario = $viewBag["usuario"];
$postagens = $viewBag["postagens"];
$postsPorSemana = $viewBag["postsPorSemana"];

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
	<p>Bem vindo, <a href="index.php?c=Visita&m=visita&usuarioId=<?= $usuario->getId(); ?>"><?= $usuario->getNome()?></a>!
	</p>
	<a href="index.php?c=Login&m=logout">Deslogar</a>
	</header>
	<section class="profile-header">
		<form class="alteraNome" method="POST" action="index.php?c=Index&m=alteraNome&usuarioId=<?= $usuario->getId(); ?>">
		<input type="text" class="nome" name="nome" value="<?= $usuario->getNome(); ?>">
			<button class="altera" type="submit">alterar</button>
		</form>

		<form class="alteraBio" method="POST" action="index.php?c=Index&m=alteraBio&usuarioId=<?= $usuario->getId(); ?>">
		<textarea class="bio" name="bio" maxlength="100"><?=$usuario->getBio();?></textarea>
			<button class="altera" type="submit">alterar</button>
		</form>
		<p>
			posts por semana: <?= $postsPorSemana ?>
		</p>

	</section>
	<section class="timeline-header container">
		<form class="post-form" method="POST" action="index.php?c=index&m=envia">
			<textarea class="text-box" name="conteudo" maxlength="140" placeholder="O que está acontecendo?"></textarea>
			<input type="hidden" name="usuarioId" value = "<?= $usuario->getId(); ?>" />
			<input class="btn-send" type="submit" value="enviar"/>
		</form>
	</section>
	<section class="timeline-content container">
			<ul class="post">
			<?php
				foreach ($postagens as $post){
			?>
					<li>
						<div class="post-header">
							<p>
								<a href="index.php?c=Visita&m=visita&usuarioId=
								<?= $usuario->getId(); ?>"><?= $usuario->getNome()?>
								</a>
							</p>
							<p>
								<?= $post->getData(); ?>
							</p>
						</div>
						<form class="altera-post" method="POST" action="index.php?c=Index&m=alteraPost&usuarioId=<?= $usuario->getId(); ?>">
							<input type="hidden" name="postId" value="<?= $post->getId() ;?>">
							<input class="conteudo" name="conteudo" value="<?= $post->getConteudo(); ?>">
							<a class="btn-remove" href="index.php?c=Index&m=remove&id=<?=$post->getId()?>&usuarioId=<?= $usuario->getId(); ?>">remover
							</a>
							<button class="btn-altera" type="submit">alterar</button>
						</form>
					</li>
			<?php 
				}
			?>
			</ul>
	</section>
</form>
</body>
</html>
