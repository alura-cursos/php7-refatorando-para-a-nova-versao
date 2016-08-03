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
		('".mysql_real_escape_string($usuario->getNome())."',
		'".mysql_real_escape_string(md5($usuario->getSenha()))."',
		'".mysql_real_escape_string($usuario->getEmail())."',
		'".mysql_real_escape_string($usuario->getBio())."',
		'".mysql_real_escape_string(date("Y-m-d"))."')";
		
		return mysql_query($query);
	}

	public function alteraNome(Usuario $usuario){
		$query = "UPDATE Usuario SET 
		Nome='".mysql_real_escape_string($usuario->getNome())."' 
		WHERE id='".mysql_real_escape_string($usuario->getId())."'";
		
		mysql_query($query);
	}

	public function alteraBio(Usuario $usuario){
		$query = "UPDATE Usuario SET 
		Bio='".mysql_real_escape_string($usuario->getBio())."' 
		WHERE id='".mysql_real_escape_string($usuario->getId())."'";
		
		mysql_query($query);
	}

	public function buscaPorId($id){
		$query = "SELECT * FROM Usuario WHERE id = '".
					mysql_real_escape_string($id)."'";
		$result = mysql_query($query);
		$usuario = mysql_fetch_object($result,'Vendor\Model\Usuario');
		return $usuario;
	}

	public function buscaPorNome($nome){
		$query = "SELECT * FROM Usuario WHERE nome = '".
					mysql_real_escape_string($nome)."'";
		$result = mysql_query($query);
		$usuario = mysql_fetch_object($result,'Vendor\Model\Usuario');
		return $usuario;
	}

	public function buscaPorEmail($email){
		$query = "SELECT * FROM Usuario WHERE email = '".
					mysql_real_escape_string($email)."'";
		$result = mysql_query($query);
		$usuario = mysql_fetch_object($result,'Vendor\Model\Usuario');
		return $usuario;
	}

	public function login($email,$senha){
		$query = "SELECT * FROM Usuario WHERE Email = '".
					mysql_real_escape_string($email).
					"' AND Senha = '".
					mysql_real_escape_string(md5($senha))."'";
		$result = mysql_query($query);
		$usuario = mysql_fetch_object($result,'Vendor\Model\Usuario');
		return $usuario;
	}
}