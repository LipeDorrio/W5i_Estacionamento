<?php 
require_once ("../../configuracao.php");
require_once ($path_inc."/resources/topo.php");
require_once ($path_inc."/classes/controller/PrecoController.php");

$id =  intval(isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$acao =  (isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '');
$qtdHora = "";
$descricao = "";
$valor = "";
if ($id > 0 && $acao=="precoEdita"){
    
    $paramPreco = array("comp"=>" and preco.id = ".$id);
    $preco = new PrecoController("precoListagem",$paramPreco);
    $qtdHora = $preco->retorno[0]->getQtdHora();
    $descricao = $preco->retorno[0]->getDescricao();
    $valor = $preco->retorno[0]->getValor();
}
?>

<div class="container">
    <div class="row">
        <form name="precoListagem" method="post" action="<?=$caminho?>telas/preco/lista.php">
            <input type="hidden" name="acao" value="<?=$acao?>">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center mb-5">Cadastro</h1>
                
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Quantidade de Hora" aria-label="Quantidade de Hora"
                        aria-describedby="button-addon2" name="qtdHora" value="<?=$qtdHora?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Descrição" aria-label="Descrição"
                        aria-describedby="button-addon2" name="descricao" value="<?=$descricao?>">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Valor" aria-label="Valor"
                        aria-describedby="button-addon2" name="valor" value="<?=$valor?>">
                </div>

                
                <div class="text-center mb-3">
                    <button  class="btn btn-primary" type="button" id="button-addon2" onclick="Valida_form();">Salvar</button>
                </div>
                <div class="text-center">
                    <a class="btn btn-secondary" href="<?= $caminho ?>telas/preco/lista.php">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<script language="JavaScript">
    function Valida_form(){
        var f = document.precoListagem;
        if (f.qtdHora.value == ""){
            alert('Descrição não pode ser vazio');
        } else if (f.descricao.value == ""){
            alert('Descrição não pode ser vazio');
        }else if (f.valor.value == ""){
            alert('Descrição não pode ser vazio');
        }else{
            f.submit();
        }
}
</script>
<?php require_once ($path_inc . "/resources/rodape.php"); ?>
