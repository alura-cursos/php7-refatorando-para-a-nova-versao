<?php 
	namespace Vendor\Lib;
	class View{
		private $view;
		private $controller;
		private $dados=[];
		public function __construct($view,$controller){
			$this->view = $view;
			$this->controller = $controller;
		}
		public function render(){
			$viewBag = $this->dados;
			$caminho = "Vendor/View/$this->controller/$this->view.php";
			include $caminho;
		}
		public function viewBag($nome,$valor){
			$this->dados[$nome] = $valor;
		}
	}