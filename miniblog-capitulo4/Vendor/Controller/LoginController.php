<?php
namespace Vendor\Controller;

use Vendor\DAO\{UsuarioDAO,PostagemDAO};
use Vendor\Factory\ConnectionFactory;
use Vendor\Lib\{View,UsuarioValidator};
use Vendor\Model\{Login,Usuario};

class LoginController{
	private $usuarioDao;
	private $postagemDao;
	private $login;
	private $validator;

	public function __construct(){
		$con = ConnectionFactory::getConnection();
		$this->usuarioDao = new UsuarioDAO($con);	
		$this->postagemDao = new PostagemDAO($con);	
		$this->validator = new UsuarioValidator();
	}

	public function index(){
		
		$view = new View('index','Login');
		return $view;
	}

	public function login(){
		$usuario = $this->usuarioDao->login($_POST["email"], $_POST["senha"]);
		
		if($usuario == null) {
			$view = new View('index','Login');
			$view->viewBag('error','Usuário ou senha inválido.');
			return $view;
		} else {
			Login::logaUsuario($usuario);
			header("Location: index.php?c=Index&m=index&usuarioId=".$usuario->getId()."");
		}
	
	}
	public function logout(){
		Login::logout();
		header("Location: index.php");
	}

	public function register(){
		$usuario = new Usuario();
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$senha = $_POST["senha"];
		$bio = $_POST["bio"];

		$usuario->setNome($nome);
		$usuario->setEmail($email);
		$usuario->setSenha($senha);
		$usuario->setBio($bio);

		$view = new View('index','Login');

		if($this->validator->validaUsuario($usuario)){

			$usuario = $this->usuarioDao->adiciona($usuario);
			$view->viewBag('register','Usuario registrado com sucesso!');
		}
		else{
			$view->viewBag('register','nome ou email já existente');
		}
		return $view;
	}
}