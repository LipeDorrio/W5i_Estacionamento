<?php
require_once ($path_inc . "/classes/service/MovimentacaoService.php");
require_once ($path_inc . "/classes/model/entity/MovimentacaoModel.php");
require_once ($path_inc . "/classes/lib/fwAction.php");

class MovimentacaoController
{
    public $retorno;
    public $action;
    private $obj;
    public $security;

    public function __construct($acao = null, $param = null)
    {
        global $config;
        $this->action = new ActionAlert();

        if ($acao == "movimentacaoListagem") {
            $obj = new MovimentacaoService();
            $this->retorno = $obj->collMovimentacao($param);
            if (!is_array($this->retorno)) {
                echo $this->action->mensagem($this->retorno, 'erro', '');
                exit;
            }
        } else if ($acao == "movimentacaoEntrada") {
            $movimentacaoService = new MovimentacaoService();
            $movimentacaoModel = new MovimentacaoModel();
            $movimentacaoModel->idVeiculo->setId((isset($_REQUEST["idVeiculo"]) ? $_REQUEST["idVeiculo"] : ""));
            $movimentacaoModel->setDtEntrada((isset($_REQUEST[date("Y-m-d H:i:s")]) ? $_REQUEST[date("Y-m-d H:i:s")] :""));

            $this->retorno = $movimentacaoService->movimentacaoEntrada($movimentacaoModel);
            if ($this->retorno == "") {
                echo $this->action->mensagem("Cadastro efetuado com sucesso!", '', '');
            } else {
                echo $this->action->mensagem($this->retorno, 'erro', '');
            }
        } else if ($acao == "movimentacaoBaixa") {
            $movimentacaoService = new MovimentacaoService();
            $movimentacaoModel = new MovimentacaoModel();
            $movimentacaoModel->setId(intval(isset($_REQUEST["id"]) ? $_REQUEST["id"] : ""));
            $movimentacaoModel->setDtSaida(date("Y-m-d H:i:s"));
            $this->retorno = $movimentacaoService->movimentacaoBaixa($movimentacaoModel);
            if ($this->retorno == "") {
                echo $this->action->mensagem("Baixa efetuada com sucesso!", '', '');
            } else {
                echo $this->action->mensagem($this->retorno, 'erro', '');
            }
        } else {
            echo $this->action->mensagem('Esta [' . $acao . '] não é uma ação válida!');
        }
    }
}
?>