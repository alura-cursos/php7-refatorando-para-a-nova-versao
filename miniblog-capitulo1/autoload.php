<?php 
	function carregaClasse($nome){
		$ds = DIRECTORY_SEPARATOR;
		$caminho = str_replace("\\", $ds, "$nome.php");
		if(file_exists($caminho)){
		include "$caminho";
		}
	}
	spl_autoload_register("carregaClasse");