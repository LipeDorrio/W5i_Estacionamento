<?php 
require_once ("../../configuracao.php"); 
require_once ($path_inc . "/resources/topo.php");
require_once($path_inc."/classes/controller/CategoriaController.php");

$acao =  (isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '');
$paramCategoria = ["comp"=>""];
$descricao = "";
if ($acao=="categoriaEdita" || $acao=="categoriaCadastro" || $acao=="categoriaExclui"){
    //buscar os dados para edição
    $categoria = new CategoriaController($acao);
    echo $categoria->retorno;
} else {
    $id =  intval( isset($_REQUEST['id']) ? $_REQUEST['id'] : '' );
    $acao =  intval( isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '' );
    $descricao = ( isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : '' );
    //Montar filtro 
    $comp = ""; 
    $comp .= ($descricao!="" ? " and categoria.descricao like '%".$descricao."%'" : "" );
    $paramCategoria = ["comp"=>$comp];
}
$categoria = new CategoriaController("categoriaListagem",$paramCategoria);
?>

<div class="container">
    <form name="categoriaListagem" method="post" action="<?=$caminho?>telas/categoria/lista.php">
        <div>

            <div>

                <label for="formGroupExampleInput2" class="form-label">Pesquisa</label>
                <input style="width:100px" type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Descrição" name="descricao" value="<?=$descricao?>">

            </div>

        </div>

        <div class="button">

            <button type="button" class="btn btn-primary" onclick="document.categoriaListagem.submit()">Pesquisar</button>

        </div>
    </form>
</div>

<div class="container">

    <div class="button">

        <a href="<?= $caminho ?>telas/categoria/cadastro.php?acao=categoriaCadastro"><button class="btn btn-primary">Novo Cadastro</button></a>

    </div>

</div>

<div class="container">

    <div class="table">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Descrição</th>
                    <th scope="col"></th>

                </tr>
            </thead>

            <tbody>
                <? for($x=0;$x<count($categoria->retorno);$x++){ ?>
                <tr>
                    <th scope="row"><? echo $categoria->retorno[$x]->getId(); ?></th>
                    <td><? echo $categoria->retorno[$x]->getDescricao(); ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary">
                            <a href="<?= $caminho ?>telas/categoria/cadastro.php?acao=categoriaEdita&id=<? echo $categoria->retorno[$x]->getId(); ?>">Editar</a>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <a href="<?= $caminho ?>telas/categoria/lista.php?acao=categoriaExclui&id=<? echo $categoria->retorno[$x]->getId(); ?>">Excluir</a>    
                        </button>
                    </td>
                </tr>
                <? } ?>
            </tbody>

        </table>

    </div>

</div>

<?php require_once ($path_inc . "/resources/rodape.php"); ?>

<style>
    .container {
        padding: 5px;
        display: column;
        flex-direction: row;
        align-items: flex-start;
    }

    .table {
        width: 100%;
        display: column;
    }

    .button {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: right;
    }
    a {
        text-decoration: none;
        color: white;
    }
</style>