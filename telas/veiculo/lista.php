<?php
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once ($path_inc . "/classes/controller/VeiculoController.php");

$acao = (isset($_REQUEST["acao"])) ? $_REQUEST["acao"] : '';
$paramVeiculo = ["comp" => ""];
$idCategoria = "";
$placa = "";
if ($acao == "veiculoEdita" || $acao == "veiculoCadastro" || $acao == "veiculoExclui") {
    $idCategoria = new VeiculoController($acao);
    echo $veiculo->retorno;
} else {
    $id = intval(isset($_REQUEST["id"]) ? intval($_REQUEST["id"]) : '');
    $acao = intval(isset($_REQUEST['acao']) ? intval($_REQUEST['acao']) : '');
    $idCategoria = intval(isset($_REQUEST['id_categoria']) ? intval($_REQUEST['id_categoria']) : '');
    $comp = "";
    $comp .= ($idCategoria != "" ? " and veiculo.id_categoria like '%" . $idCategoria . "%'" : "");
    $comp .= ($placa != "" ? " and veiculo.placa like '%" . $placa . "%'" : "");
    $paramVeiculo = ["comp" => $comp];
}
$veiculo = new VeiculoController("veiculoListagem", $paramVeiculo);

?>

<div class="container">
    <form name="veiculoListagem" method="post" action="<?= $caminho ?>">
        <div>

            <div>

                <label for="formGroupExampleInput2" class="form-label">Categoria</label>
                <input style="width:100px" type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Categoria" name="idCategoria" value="<?= $idCategoria ?>">
                <label for="formGroupExampleInput2" class="form-label">Placa</label>
                <input style="width:100px" type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Placa" name="placa" value="<? $placa ?>">

            </div>
            <div class="button">

                <button type="button" class="btn btn-primary"
                    onclick="document.veiculo.Listagem.submit()">Pesquisar</button>

            </div>
        </div>
    </form>

</div>

<div class="container">

    <div class="button">

        <a href="<?= $caminho ?>telas/veiculo/cadastro.php?acao=veiculoCadastro"><button class="btn btn-primary">Novo
                Cadastro</button></a>

    </div>

</div>

<div class="container">

    <div class="table">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Placa</th>
                    <th scope="col"></th>

                </tr>
            </thead>

            <tbody>
                <? for ($x = 0; $x < count($veiculo->retorno); $x++) { ?>
                    <tr>
                        <th scope="row">
                            <? echo $veiculo->retorno[$x]->getId(); ?>
                        </th>
                        <td>
                            <? echo $veiculo->retorno[$x]->getIdCategoria(); ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary">
                                <a
                                    href="<?= $caminho ?>telas/veiculo/cadastro.php?acao=veiculoEdita&id=<? echo $veiculo->retorno[$x]->getId(); ?>">Editar</a>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <a
                                    href="<?= $caminho ?>telas/veiculo/lista.php?acao=veiculoExclui&id=<? echo $veiculo->retorno[$x]->getId(); ?>">Excluir</a>
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

    .button {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: right;
    }
</style>