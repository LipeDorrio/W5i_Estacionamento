<?php
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once ($path_inc . "/classes/controller/VeiculoController.php");

$id = intval(isset($_REQUEST["id"]) ? $_REQUEST["id"] : '');
$acao = (isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '');
$idCategoria = "";
$placa = "";
if ($id > 0 && $acao == "veiculoEdita") {
    //busca dos dados 
    $paramVeiculo = array("comp" => " and veiculo.id =" . $id);
    $veiculo = new VeiculoController("veiculoListagem", $paramVeiculo);
    $idCategoria = $veiculo->retorno[0]->getIdCategoria();
    $placa = $veiculo->retorno[0]->getPlaca();
}
?>

<div class="container">
    <div class="row">
        <form name="veiculoListagem" method="post" action="<?= $caminho ?>telas/veiculo/lista.php">
            <input type="hidden" name="acao" value="<?= $acao ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center mb-5">Cadastro</h1>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Categoria" aria-label="Categoria"
                        aria-describedby="button-addon2" name="idCategoria" value="<?=$idCategoria?>">
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Placa" aria-label="Placa"
                        aria-describedby="button-addon2" name="placa" value="<?= $placa ?>">
                </div>

                <div class="text-center mb-3">
                    <button class="btn btn-primary" type="button" id="button-addon2"
                        onclick="Valida_form();">Salvar</button>
                </div>
                <div class="text-center">
                    <a class="btn btn-secondary" href="<?= $caminho ?>telas/veiculo/lista.php">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<script language="JavaScript">
    function Valida_form(){
        var f =document.veiculoListagem;
        if (f.placa.value == ""){
            alert('Placa não pode ser vazio')
        }else if(f.idCategoria == ""){
            alert('Precisa selecionar alguma categoria')
        }else {
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