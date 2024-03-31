<?php 
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once($path_inc."/classes/controller/CategoriaController.php");

$id =  intval(isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$acao =  (isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '');
$descricao = "";
if ($id > 0 && $acao=="categoriaEdita"){
    //buscar os dados para edição
    $paramCategoria = array("comp"=>" and categoria.id = ".$id);
    $categoria = new CategoriaController("categoriaListagem",$paramCategoria);
    $descricao = $categoria->retorno[0]->getDescricao();
}
?>

<div class="container">
    <div class="row">
        <form name="categoriaListagem" method="post" action="<?=$caminho?>telas/categoria/lista.php">
            <input type="hidden" name="acao" value="<?=$acao?>">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center mb-5">Cadastro</h1>
                
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Descrição" aria-label="Descrição"
                        aria-describedby="button-addon2" name="descricao" value="<?=$descricao?>">
                </div>
                
                <div class="text-center mb-3">
                    <button  class="btn btn-primary" type="button" id="button-addon2" onclick="Valida_form();">Salvar</button>
                </div>
                <div class="text-center">
                    <a class="btn btn-secondary" href="<?= $caminho ?>telas/categoria/lista.php">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<script language="JavaScript">
    function Valida_form(){
        var f = document.categoriaListagem;
        if (f.descricao.value == ""){
            alert('Descrição não pode ser vazio');
        } else {
            f.submit();
        }
}
</script>
<?php require_once ($path_inc . "/resources/rodape.php"); ?>

<style>
    .container {
        margin-top: 60px;
    }

    .input-group {
        margin-bottom: 20px;
    }
</style>