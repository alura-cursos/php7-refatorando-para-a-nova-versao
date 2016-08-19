<?php 

namespace Vendor\Lib;

use Vendor\Dao\UsuarioDAO;
use Vendor\Factory\ConnectionFactory;

class UsuarioValidator{
	private $usuarioDao;

	public function __construct(){
		$con = ConnectionFactory::getConnection();
		$this->usuarioDao = new UsuarioDAO($con);
	}

	public function validaUsuario($usuario){

		$nomeValido = $this->usuarioDao->buscaPorNome($usuario->getNome());
		$emailValido = $this->usuarioDao->buscaPorEmail($usuario->getEmail());

		if($nomeValido == FALSE 
			&& $emailValido == FALSE 
			&& self::validaNome($usuario->getNome())
			&& self::validaEmail($usuario->getEmail())
			&& self::validaSenha($usuario->getSenha())){
			return true;
		}
		else{
			return false;
		}
	}

	public function validaUsuarioPost($conteudo){
		if(strlen($conteudo)<=140 && strlen($conteudo)>0){
			return true;
		}
		else{
			return false;
		}
	}

	public function validaNome($nome){
		if(strlen($nome)>0){
			return true;
		}
		else{
			return false;
		}
	}

	public function validaEmail($email){
		if(strlen($email)>0){
			return true;
		}
		else{
			return false;
		}
	}

	public function validaSenha($senha){
		if(strlen($senha)>0){
			return true;
		}
		else{
			return false;
		}
	}
	public function validaBio($bio){
		if(strlen($bio)<=140 && strlen($bio)>0){
			return true;
		}
		else{
			return false;
		}
	}
}