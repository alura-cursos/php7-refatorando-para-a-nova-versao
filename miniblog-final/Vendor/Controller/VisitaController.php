<?php
namespace Vendor\Controller;

use Vendor\Model\{Postagem,Usuario,Noticia,Login};
use Vendor\DAO\{PostagemDAO,UsuarioDAO};
use Vendor\Lib\View;
use Vendor\Factory\ConnectionFactory;

class VisitaController{
	private $postagemDao;
	private $usuarioDao;

	public function __construct(){
		$con = ConnectionFactory::getConnection();
		$this->postagemDao = new PostagemDAO($con);
		$this->usuarioDao = new UsuarioDAO($con);
	}


public function visita(){
		$view = new View('index','Visita');
			$usuario = $this->usuarioDao->buscaPorId($_GET["usuarioId"]);
			$usuarioLogado = Login::getUsuario();
			$postagens = $this->postagemDao->lista($usuario->getId());
			$postsPorSemana = $this->postagemDao->postsPorSemana($usuario->getId());
			
			$view->viewBag('postagens',$postagens);
			$view->viewBag('postsPorSemana',$postsPorSemana);
			$view->viewBag('usuario',$usuario);
			$view->viewBag('usuarioLogado',$usuarioLogado);

			return $view;
	}
}