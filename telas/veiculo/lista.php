<?php
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once ($path_inc . "/classes/controller/VeiculoController.php");
require_once ($path_inc . "/classes/controller/CategoriaController.php"); 

$acao = (isset($_REQUEST["acao"])) ? $_REQUEST["acao"] : '';
$paramVeiculo = ["comp" => ""];
$idCategoria = "";
$placa = "";
if ($acao == "veiculoEdita" || $acao == "veiculoCadastro" || $acao == "veiculoExclui") {
    $veiculo = new VeiculoController($acao);
    echo $veiculo->retorno;
} else {
    $idCategoria = (isset($_REQUEST['idCategoria']) ? $_REQUEST['idCategoria'] : '');
    $placa = (isset($_REQUEST['placa']) ? $_REQUEST['placa'] : '');
    $comp = "";
    $comp .= ($idCategoria != "" ? " and veiculo.id_categoria = '" . $idCategoria . "'" : "");
    $comp .= ($placa != "" ? " and veiculo.placa like '%" . $placa . "%'" : "");
    $paramVeiculo = ["comp" => $comp];
}
$veiculo = new VeiculoController("veiculoListagem", $paramVeiculo);
?>

<div class="container">
    <form name="veiculoListagem"  method="post" action="<?= $caminho ?>telas/veiculo/lista.php">
        <div>

            <div>
                <? $categoria = new CategoriaController("categoriaListagem", null); ?>
                <label for="formGroupExampleInput2" class="form-label">Categoria</label>
                <select name="idCategoria" class="form-select" style="width:20%">
                    <option value="">Selecione</option> 
                    <? for ($x = 0; $x < count($categoria->retorno); $x++) { ?>
                        <option value="<? echo $categoria->retorno[$x]->getId(); ?>"><? echo $categoria->retorno[$x]->getDescricao(); ?></option> 
                    <? } ?>
                </select>
                <script>document.veiculoListagem.idCategoria.value = '<?=$idCategoria?>'</script>
                <label for="formGroupExampleInput2" class="form-label">Placa</label>
                <input style="width:100px" type="text" class="form-control" id="formGroupExampleInput2"
                    placeholder="Placa" name="placa" value="<?=$placa?>">

            </div>
            <div class="button">

                <button type="button" class="btn btn-primary"
                    onclick="document.veiculoListagem.submit()">Pesquisar</button>

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
                            <? echo $veiculo->retorno[$x]->idCategoria->getDescricao(); ?>
                        </td>
                        <td>
                            <? echo $veiculo->retorno[$x]->getPlaca(); ?>
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
