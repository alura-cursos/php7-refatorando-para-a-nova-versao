<?php 
namespace Vendor\Factory;

class ConnectionFactory{
	public static function getConnection(){

		$con = mysql_connect('127.0.0.1', 'root', '');
		mysql_select_db('miniblog');
		if (!$con) {
    		die('Não foi possível conectar: ' . mysql_error());
		}

		return $con;
	}
}
