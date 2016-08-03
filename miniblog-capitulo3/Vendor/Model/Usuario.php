<?php 
namespace Vendor\Model;

class Usuario{
	
	private $id;
	private $nome;
	private $senha;
	private $email;
	private $bio;
	private $dataDeIngresso;
	
	public function getId(){
		return $this->id;
	}
	public function getNome(){
		return $this->nome;
	}
	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function getBio(){
		return $this->bio;
	}
	public function setBio($bio){
		$this->bio = $bio;
	}
	public function getDataDeIngresso(){
		return $this->dataDeIngresso;
	}
}