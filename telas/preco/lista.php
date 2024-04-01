<?php
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once ($path_inc . "/classes/controller/PrecoController.php");

$acao = (isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '');
$paramPreco = ["comp" => ""];
$qtdHora = "";
$descricao = "";
$valor = "";
if ($acao == "precoEdita" || $acao == "precoCadastro" || $acao == "precoExclui") {
    $preco = new PrecoController($acao);
    echo $preco->retorno;
} else {
    $id = intval(isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
    $qtdHora = (isset($_REQUEST['qtdHora']) ? $_REQUEST['qtdHora'] : '');
    $descricao = (isset($_REQUEST['descricao']) ? $_REQUEST['descricao'] : '');
    $valor = (isset($_REQUEST['valor']) ? $_REQUEST['valor'] : '');
    $comp = "";
    $comp .= ($qtdHora != "" ? " and preco.qtd_hora = " . $qtdHora . "" : "");
    $comp .= ($descricao != "" ? " and preco.descricao like '%" . $descricao . "%'" : "");
    $comp .= ($valor != "" ? " and preco.valor = " . $valor . " " : " ");
    $paramPreco = ["comp" => $comp];
}
$preco = new PrecoController("precoListagem", $paramPreco);
?>

<div class="container">
    <form name="precoListagem" method="post" action="<?= $caminho ?>telas/preco/lista.php">
        <div>

            <div>
                <label for="formGroupExampleInput2" class="form-label">QtdHora</label>
                <input style="width:160px" type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Quantidade Hora" name="qtdHora" value="<?= $qtdHora ?>">
            </div>
            <div>
                <label for="formGroupExampleInput2" class="form-label">Descrição</label>
                <input style="width:160px" type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Descrição" name="descricao" value="<?= $descricao ?>">
            </div>
        </div>
        <div class="button">
            <button type="button" class="btn btn-primary" onclick="document.precoListagem.submit()">Pesquisar</button>
        </div>
    </form>
</div>

<div class="container">

    <div class="button">

        <a href="<?= $caminho ?>telas/preco/cadastro.php?acao=precoCadastro"><button class="btn btn-primary">Novo
                Cadastro</button></a>

    </div>

</div>

<div class="container">

    <div class="table">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">QtdHora</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">valor</th>
                    <th scope="col"></th>

                </tr>
            </thead>

            <tbody>
                <? for ($x = 0; $x < count($preco->retorno); $x++) { ?>
                    <tr>
                        <th scope="row">
                            <? echo $preco->retorno[$x]->getId(); ?>
                        </th>
                        <td>
                            <? echo $preco->retorno[$x]->getQtdHora(); ?>
                        </td>
                        <td>
                            <? echo $preco->retorno[$x]->getDescricao(); ?>
                        </td>
                        <td>
                            <? echo $preco->retorno[$x]->getValor(); ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                <a
                                    href="<?= $caminho ?>telas/preco/cadastro.php?acao=precoEdita&id=<? echo $preco->retorno[$x]->getId(); ?>">Editar</a>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <a
                                    href="<?= $caminho ?>telas/preco/lista.php?acao=precoExclui&id=<? echo $preco->retorno[$x]->getId(); ?>">Excluir</a>
                            </button>
                        </td>
                    </tr>
                <? } ?>
            </tbody>

        </table>

    </div>

</div>

<?php require_once ($path_inc . "/resources/rodape.php"); ?>