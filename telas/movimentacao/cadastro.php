<?php
require_once ("../../configuracao.php");
require_once ($path_inc . "/resources/topo.php");
require_once ($path_inc . "/classes/controller/MovimentacaoController.php");
require_once ($path_inc . "/classes/controller/VeiculoController.php"); 

$id = intval(isset($_REQUEST["id"]) ? $_REQUEST["id"] : '');
$acao = (isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '');
$idVeiculo = "";
?>
<div class="container">
    <div class="row">
        <form name="movimentacaoListagem" method="post" action="<?= $caminho ?>telas/movimentacao/lista.php">
            <input type="hidden" name="acao" value="<?= $acao ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center mb-5">Cadastro</h1>
                <div class="input-group mb-3">
                    <? $veiculo = new VeiculoController("veiculoListagem", null); ?>
                    <label for="formGroupExampleInput2" class="form-label">Placa Do veículo</label>
                    <select name="idVeiculo" class="form-select" style="width:20%">
                        <option value="">Selecione</option> 
                        <? for ($x = 0; $x < count($veiculo->retorno); $x++) { ?>
                            <option value="<? echo $veiculo->retorno[$x]->getId(); ?>"><? echo $veiculo->retorno[$x]->getPlaca(); ?></option> 
                        <? } ?>
                    </select>
                    <script>document.movimentacaoListagem.idVeiculo.value = '<?=$idVeiculo?>'</script>
                </div>
                <label for="formGroupExampleInput2" class="form-label">Data entrada</label>
                <input style="width:160px" type="date" class="form-control" id="formGroupExampleInput2"
                    placeholder="Data entrada" name="dtEntrada" value="<?= $dtEntrada ?>">
                    <button class="btn btn-primary" type="button" id="button-addon2"
                        onclick="Valida_form();">Salvar</button>
                </div>
                <div class="text-center">
                    <a class="btn btn-secondary" href="<?= $caminho ?>telas/movimentacao/lista.php">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<script language="JavaScript">
    function Valida_form(){
        var f =document.movimentacaoListagem;
        if(f.idVeiculo.value == ""){
            alert('Precisa selecionar algum veículo');
        }else if(f.dtEntrada.value == ""){
            alert("Precisa colocar a data de entrada");
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