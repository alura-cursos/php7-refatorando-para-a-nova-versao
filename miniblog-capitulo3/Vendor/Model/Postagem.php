<?php 
namespace Vendor\Model;

class Postagem{

	private $id;
	private $conteudo;
	private $data;

	public function getConteudo(){
		return $this->conteudo;
	}
	public function setConteudo($conteudo){
		$this->conteudo = $conteudo;
	}
	public function setData($data){
		$this->data = $data;
	}
	public function getData(){
		return $this->data;
	}
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
}