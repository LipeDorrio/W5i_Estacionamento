<?php 
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once($path_inc."/classes/controller/.php");

$id =  intval(isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$acao =  (isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '');
$valor = "";
$descricao = "";
if ($id > 0 && $acao=="categoriaEdita"){
    //buscar os dados para edição
    $paramCategoria = array("comp"=>" and categoria.id = ".$id);
    $categoria = new CategoriaController("categoriaListagem",$paramCategoria);
    $descricao = $categoria->retorno[0]->getDescricao();
}
?>