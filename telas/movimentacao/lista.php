<?php
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once ($path_inc . "/classes/controller/MovimentacaoController.php");
require_once ($path_inc . "/classes/controller/VeiculoController.php");
require_once ($path_inc . "/classes/controller/CategoriaController.php");

$acao = (isset($_REQUEST["acao"])) ? $_REQUEST["acao"] : '';
$paramMovimentacao = ["comp" => ""];
$idVeiculo = "";
$placa = "";
if ($acao == "movimentacaoBaixa" || $acao == "movimentacaoEntrada" ) {
    $movimentacao = new MovimentacaoController($acao);
    echo $movimentacao->retorno;
} else {
    $idVeiculo = (isset($_REQUEST['idVeiculo']) ? $_REQUEST['idVeiculo'] : '');
    $placa = (isset($_REQUEST['placa']) ? $_REQUEST['placa'] : '');

    $dtEntrada = (isset($_REQUEST['dtEntrada']) ? $_REQUEST['dtEntrada'] : '');
    $dtSaida = (isset($_REQUEST['dtSaida']) ? $_REQUEST['dtSaida'] : '');
    $comp = "";
    $comp .= ($idVeiculo != "" ? " and movimentacao.id_veiculo = '" . $idVeiculo . "'" : "");
    $comp .= ($placa != "" ? " and veiculo.placa like '%" . $placa . "%'" : "");
    if ($dtEntrada != "" && $dtSaida != "") {
        $comp .= " and movimentacao.dt_entrada between '" . $dtEntrada . "' and '" . $dtSaida . " 23:59:59'";
    } else if ($dtEntrada != "") {
        $comp .= " and movimentacao.dt_entrada >= '" . $dtEntrada . "' ";
    }
    $paramMovimentacao = ["comp" => $comp];
}
$movimentacao = new MovimentacaoController("movimentacaoListagem", $paramMovimentacao);
?>

<div class="container">
    <form name="movimentacaoListagem" method="post" action="<?= $caminho ?>telas/movimentacao/lista.php">
        <div>

            <div>
                <? $veiculo = new VeiculoController("veiculoListagem", null); ?>
                <? $categoria = new CategoriaController("categoriaListagem", null); ?>
                <label for="formGroupExampleInput2" class="form-label">Categoria</label>
                <select name="descricao" class="form-select" style="width:20%">
                    <option value="">Selecione</option>
                    <? for ($x = 0; $x < count($categoria->retorno); $x++) { ?>
                        <option value="<? echo $categoria->retorno[$x]->getId(); ?>">
                            <? echo $categoria->retorno[$x]->getDescricao(); ?>
                        </option>
                    <? } ?>
                </select>
                <script>document.movimentacaoListagem.idVeiculo.value = '<?= $idVeiculo ?>'</script>

                <label for="formGroupExampleInput2" class="form-label">Placa</label>
                <input style="width: 160px" type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Placa" name="placa" value="<?= $placa ?>">

                <label for="formGroupExampleInput2" class="form-label">Data entrada</label>
                <input style="width:160px" type="date" class="form-control" id="formGroupExampleInput2"
                    placeholder="Data entrada" name="dtEntrada" value="<?= $dtEntrada ?>">

                <label for="formGroupExampleInput2" class="form-label">Data Saida</label>
                <input style="width:160px" type="date" class="form-control" id="formGroupExampleInput2"
                    placeholder="Data Saida" name="dtSaida" value="<?= $dtSaida ?>">


            </div>
            <div class="button">

                <button type="button" class="btn btn-primary"
                    onclick="document.movimentacaoListagem.submit()">Pesquisar</button>

            </div>
        </div>
    </form>

</div>

<div class="container">

    <div class="button">

        <a href="<?= $caminho ?>telas/movimentacao/cadastro.php?acao=movimentacaoEntrada"><button
                class="btn btn-primary">Novo
                Cadastro</button></a>

    </div>

</div>

<div class="container">

    <div class="table">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Placa</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Data Entrada</th>
                    <th scope="col">Data Saida</th>
                    <th scope="col">Valor Cobrado</th>
                    <th scope="col">Permanência</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                <? for ($x = 0; $x < count($movimentacao->retorno); $x++) { ?>
                    <tr>
                        <th scope="row">
                            <? echo $movimentacao->retorno[$x]->getId(); ?>
                        </th>
                        <td>
                            <? echo $movimentacao->retorno[$x]->idVeiculo->getPlaca(); ?>
                        </td>
                        <td>
                            <? echo $movimentacao->retorno[$x]->idVeiculo->idCategoria->getDescricao(); ?>
                        </td>
                        <td>
                            <? echo $movimentacao->retorno[$x]->getDtEntrada(); ?>
                        </td>
                        <td>
                            <? echo $movimentacao->retorno[$x]->getDtSaida(); ?>
                        </td>
                        <td>
                           <? echo $movimentacao->retorno[$x]->getValorCobrado(); ?>
                        </td> 
                        <td>
                           <? echo $movimentacao->retorno[$x]->getQtdHoras(); ?>
                        </td> 
                        <td>
                            <button class="btn btn-sm btn-primary">
                                <a
                                    href="<?= $caminho ?>telas/movimentacao/lista.php?acao=movimentacaoBaixa&id=<? echo $movimentacao->retorno[$x]->getId(); ?>">Baixa</a>
                            </button>
                        </td>
                    </tr>
                <? } ?>
            </tbody>

        </table>

    </div>

</div>

<?php require_once ($path_inc . "/resources/rodape.php"); ?>