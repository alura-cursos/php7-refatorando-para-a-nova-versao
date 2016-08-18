<?php

namespace Vendor\DAO;
use Vendor\Model\Postagem;
use Vendor\DAO\UsuarioDAO;

class PostagemDAO{
	private $con;
	private $usuarioDao;

	public function __construct($con){
		$this->con = $con;
		$this->usuarioDao = new UsuarioDao($con);
	}
	
	public function adiciona(Postagem $postagem, $usuarioId){
		$query = "INSERT INTO Postagem (conteudo, data, usuarioId) VALUES (
		'".mysql_real_escape_string($postagem->getConteudo())."',
		'".mysql_real_escape_string($postagem->getData())."',
		'".mysql_real_escape_string($usuarioId)."')";

		return mysql_query($query);
	}

	public function altera(Postagem $postagem){
		$query = "UPDATE Postagem SET 
		conteudo='".mysql_real_escape_string($postagem->getConteudo())."' 
		WHERE id='".mysql_real_escape_string($postagem->getId())."'";
		
		return mysql_query($query);
	}

	public function remove($id){
		$query = "DELETE FROM Postagem WHERE id = {$id}";
		$result = mysql_query($query);
		return $result;
	}

	public function lista($id){
		$query = "SELECT * FROM Postagem WHERE usuarioId = {$id} ORDER BY id DESC";
		$result = mysql_query($query);
		$postagens = array();
		while ($postagem = mysql_fetch_object($result,'Vendor\Model\Postagem')) {
    		$postagem->setData(date("d/m/Y", strtotime($postagem->getData())));

    		array_push($postagens, $postagem);
		}
		return $postagens;
	}
	public function postsPorSemana($usuarioId) {
		$query = "SELECT * FROM Postagem WHERE usuarioId = {$usuarioId}";
		$result = mysql_query($query);

		$postagens = array();
		
		while ($postagem = mysql_fetch_object($result,'Vendor\Model\Postagem')) {
    		array_push($postagens, $postagem);
		}
		
		$numeroDePostagens = sizeof($postagens);
		
		$hoje = new \DateTime(date("Y-m-d"));

		$dataDeIngresso = new \dateTime($this->usuarioDao->buscaPorId($usuarioId)->getDataDeIngresso());

		$diferenca;

		if($hoje->diff($dataDeIngresso)->days == 0){
			$diferenca = 1;		
		}
		else{
			$diferenca = $hoje->diff($dataDeIngresso)->days/7;
		}
		return ($numeroDePostagens / $diferenca);
	}
}
