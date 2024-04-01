<?php
require_once ($path_inc . "/classes/service/VeiculoService.php");
require_once ($path_inc . "/classes/model/entity/VeiculoModel.php");
require_once ($path_inc . "/classes/lib/fwAction.php");

class VeiculoController
{
    public $retorno;
    public $action;
    private $obj;
    public $security;

    public function __construct($acao = null, $param = null)
    {
        global $config;
        $this->action = new ActionAlert();

        if ($acao == "veiculoListagem") {
            $obj = new VeiculoService();
            $this->retorno = $obj->collVeiculo($param);
            if (!is_array($this->retorno)) {
                echo $this->action->mensagem($this->retorno, 'erro', '');
                exit;
            }
        } else if ($acao == "veiculoCadastro") {
            $veiculoService = new VeiculoService();
            $veiculoModel = new VeiculoModel();
            $veiculoModel->idCategoria->setId((isset($_REQUEST["idCategoria"]) ? $_REQUEST["idCategoria"] : ""));
            $veiculoModel->setPlaca((isset($_REQUEST["placa"]) ? $_REQUEST["placa"] : ""));

            $this->retorno = $veiculoService->veiculoCadastro($veiculoModel);
            if ($this->retorno == "") {
                echo $this->action->mensagem("Cadastro efetuado com sucesso!", '', '');
            } else {
                echo $this->action->mensagem($this->retorno, 'erro', '');
            }
        } else if ($acao == "veiculoEdita") {
            $veiculoService = new VeiculoService();
            $veiculoModel = new VeiculoModel();
            $veiculoModel->setId(intval(isset($_REQUEST["id"]) ? $_REQUEST["id"] : ""));
            $veiculoModel->idCategoria->setId(intval(isset($_REQUEST["idCategoria"]) ? $_REQUEST["idCategoria"] : ""));
            $veiculoModel->setPlaca((isset($_REQUEST["placa"]) ? $_REQUEST["placa"] : ""));
            $this->retorno = $veiculoService->veiculoCadastro($veiculoModel);
            if ($this->retorno == "") {
                echo $this->action->mensagem("Edição efetuada com sucesso!", '', '');
            } else {
                echo $this->action->mensagem($this->retorno, 'erro', '');
            }
        } else if ($acao == "veiculoExclui") {
            $veiculoService = new VeiculoService();
            $veiculoModel = new VeiculoModel();
            $veiculoModel->setId(intval(isset($_REQUEST["id"]) ? $_REQUEST["id"] : ""));

            $this->retorno = $veiculoService->veiculoExclui($veiculoModel);
            if ($this->retorno == "") {
                echo $this->action->mensagem("Exclusão efetuada com sucesso!", 'exclui', '');
            } else {
                echo $this->action->mensagem($this->retorno, 'erro', '');
            }
        } else {
            echo $this->action->mensagem('Esta [' . $acao . '] não é uma ação válida!');
        }
    }
}
?>