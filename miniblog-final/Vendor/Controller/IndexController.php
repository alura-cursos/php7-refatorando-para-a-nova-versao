<?php
namespace Vendor\Controller;

use Vendor\Model\{Postagem,Usuario,Noticia,Login};
use Vendor\DAO\{PostagemDAO,UsuarioDAO};
use Vendor\Lib\{UsuarioValidator,View};
use Vendor\Factory\ConnectionFactory;

class IndexController{
	private $postagemDao;
	private $usuarioDao;
	private $validator;

	public function __construct(){
		$con = ConnectionFactory::getConnection();
		$this->postagemDao = new PostagemDAO($con);
		$this->usuarioDao = new UsuarioDAO($con);
		$this->validator = new UsuarioValidator();
	}

	public function index(){
		$usuarioId = $_GET["usuarioId"];
		if(Login::usuarioEstaLogado() && $_SESSION["usuario_logado"]->getId() == $usuarioId){
			$postagens = $this->postagemDao->lista($usuarioId);
			$postsPorSemana = $this->postagemDao->postsPorSemana($usuarioId);

			$view = new View('index','Postagem');

			$view->viewBag('postagens',$postagens);
			$view->viewBag('postsPorSemana',$postsPorSemana);
			$view->viewBag('usuario',$this->usuarioDao->buscaPorId($usuarioId));

			return $view;
		}
		else{
			header("Location: index.php?c=Visita&m=visita&usuarioId=".$usuarioId);
		}
	}

	public function envia(){
		
		$conteudo = $_POST["conteudo"];
		$usuarioId = $_POST["usuarioId"];
		
		if($this->validator->validaUsuarioPost($conteudo)){
			$postagem = new Postagem();
			$postagem->setConteudo($conteudo);
			$postagem->setData(date("Y-m-d H:i:s"));

			$this->postagemDao->adiciona($postagem,$usuarioId);
			header("Location: index.php?c=Index&m=index&usuarioId=".$usuarioId);
		}
		else{
			header("Location: index.php?c=Index&m=index&usuarioId=".$usuarioId);
		}
	}

	public function alteraNome(){
		$nome = $_POST['nome'];
		$id= $_GET['usuarioId'];

		$usuario = $this->usuarioDao->buscaPorId($id);
		$usuario->setNome($nome);

		if($this->validator->validaNome($nome)){
		$this->usuarioDao->alteraNome($usuario);
		}
		
		header("Location: index.php?c=Index&m=index&usuarioId=".$usuario->getId());
	}

	public function alteraBio(){
		$bio = $_POST['bio'];
		$id= $_GET['usuarioId'];

		$usuario = $this->usuarioDao->buscaPorId($id);
		$usuario->setBio($bio);

		if($this->validator->validaBio($bio)){
		$this->usuarioDao->alteraBio($usuario);
		}

		header("Location: index.php?c=Index&m=index&usuarioId=".$usuario->getId());
	}
	public function alteraPost(){
		$conteudo = $_POST['conteudo'];
		$postId = $_POST['postId'];
		$usuarioId = $_GET['usuarioId'];

		if($this->validator->validaUsuarioPost($conteudo)){
			$postagem = new Postagem();
			$postagem->setConteudo($conteudo);
			$postagem->setId($postId);

			$this->postagemDao->altera($postagem);

			header("Location: index.php?c=Index&m=index&usuarioId=".$usuarioId);
		}
		else{
			header("Location: index.php?c=Index&m=index&usuarioId=".$usuarioId);
		}
	}
	public function remove(){
		$id = $_GET["id"];
		$usuarioId = $_GET["usuarioId"];
		$this->postagemDao->remove($id);
		header("Location: index.php?c=Index&m=index&usuarioId=".$usuarioId);
		}
}