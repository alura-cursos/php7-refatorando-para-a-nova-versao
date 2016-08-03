<?php

namespace Vendor\DAO;
use Vendor\Model\Usuario;

class UsuarioDAO{
	private $con;

	public function __construct($con){
		$this->con = $con;
	}
	

	public function adiciona(Usuario $usuario){		
		$query = "INSERT INTO Usuario (nome,senha,email,bio,dataDeIngresso) VALUES 
		(:nome,:senha,:email,:bio,:dataDeIngresso)";

		$stm = $this->con->prepare($query);
		$stm->bindValue(":nome",$usuario->getNome());
		$stm->bindValue(":senha",md5($usuario->getSenha()));
		$stm->bindValue(":email",$usuario->getEmail());
		$stm->bindValue(":bio",$usuario->getBio());
		$stm->bindValue(":dataDeIngresso",date("Y-m-d"));

		return $stm->execute();
	}

	public function alteraNome(Usuario $usuario){
		$query = "UPDATE Usuario SET Nome=:nome WHERE id=:id";
		
		$stm = $this->con->prepare($query);
		$stm->bindValue(":nome",$usuario->getNome());
		$stm->bindValue(":id",$usuario->getId());

		return $stm->execute();
	}

	public function alteraBio(Usuario $usuario){
		$query = "UPDATE Usuario SET Bio=:bio WHERE id=:id";

		$stm = $this->con->prepare($query);
		$stm->bindValue(":bio",$usuario->getBio());
		$stm->bindValue(":id",$usuario->getId());

		return $stm->execute();
	}

	public function buscaPorId(int $id) : Usuario{
		$query = "SELECT * FROM Usuario WHERE id = :id";
		
		$stm = $this->con->prepare($query);

		$stm->bindValue(":id",$id);

		$stm->execute();
		$usuario = $stm->fetchObject('Vendor\Model\Usuario');

		return $usuario;
	}

	public function buscaPorNome(String $nome) : Usuario{
		$query = "SELECT * FROM Usuario WHERE nome = :nome";

		$stm = $this->con->prepare($query);
		$stm->bindValue(":nome",$nome);

		$stm->execute();
		$usuario = $stm->fetchObject('Vendor\Model\Usuario');

		return $usuario;
	}

	public function buscaPorEmail(String $email) : Usuario{
		$query = "SELECT * FROM Usuario WHERE email = :email";
		
		$stm = $this->con->prepare($query);
		$stm->bindValue(":email",$email);

		$stm->execute();
		$usuario = $stm->fetchObject('Vendor\Model\Usuario');

		return $usuario;
	}

	public function login(String $email,String $senha) : Usuario{
		$query = "SELECT * FROM Usuario WHERE Email = :email AND Senha = :senha";

		$stm = $this->con->prepare($query);
		$stm->bindValue(":email",$email);
		$stm->bindValue(":senha",md5($senha));

		$stm->execute();
		$usuario = $stm->fetchObject('Vendor\Model\Usuario');
		return $usuario;
	}

}