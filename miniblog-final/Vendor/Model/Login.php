<?php
namespace Vendor\Model;

class Login{
	
	public static function usuarioEstaLogado() {
		session_start();
		return isset($_SESSION["usuario_logado"]);
	}

	public static function getUsuario(){
		session_start();
		return $_SESSION["usuario_logado"];
	}

	public static function logaUsuario($usuario) {
		session_start();
		
		$_SESSION["usuario_logado"] = $usuario;
	}

	public static function logout() {
		session_start();
		session_unset();
	}
}