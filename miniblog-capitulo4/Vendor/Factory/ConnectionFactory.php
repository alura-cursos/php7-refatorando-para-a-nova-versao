<?php 
namespace Vendor\Factory;

class ConnectionFactory{
	public static function getConnection(){
		
		$pdo = new \PDO('mysql:host=localhost;dbname=miniblog','root','');
		$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $pdo;
	}
}