<?php
require_once($path_inc."/classes/service/PrecoService.php");
require_once($path_inc."/classes/model/entity/PrecoModel.php");
require_once($path_inc."/classes/lib/fwAction.php");

Class PrecoController {

	public $retorno;
	public $action;
	private $obj;
	public $security;

	public function __construct($acao = null, $param = null) {
		global $caminho;
		$this->action = new ActionAlert();
		
		if ($acao == "precoListagem") {
			$obj = new PrecoService();
			$this->retorno = $obj->collPreco($param);
			if(!is_array($this->retorno)){
				echo $this->action->mensagem($this->retorno, 'erro', '');
				exit;
			}
		} else if ($acao == "precoCadastro") {
			$precoService = new PrecoService();
			$precoModel = new PrecoModel();
            $precoModel->setQtdHora(floatval(isset($_REQUEST["qtdHora"]) ? $_REQUEST["qtdHora"]:"")); 
			$precoModel->setDescricao((isset($_REQUEST["descricao"]) ? $_REQUEST["descricao"] : "" ));
            $precoModel->setValor(floatval(isset($_REQUEST["valor"])? $_REQUEST["valor"]:""));
			
			$this->retorno = $precoService->precoCadastro($precoModel);
			if ($this->retorno == ""){
				echo $this->action->mensagem("Cadastro efetuado com sucesso!", '', '');
			} else {
				echo $this->action->mensagem($this->retorno, 'erro', '');
			}
		} else if ($acao == "precoEdita") {
			$precoService = new PrecoService();
			$precoModel = new PrecoModel();
			$precoModel->setId(intval( isset($_REQUEST["id"]) ? $_REQUEST["id"] : "" ));
            $precoModel->setQtdHora((floatval($_REQUEST["qtdHora"]) ? $_REQUEST["qtdHora"] : "" ));
            $precoModel->setDescricao((isset($_REQUEST["descricao"]) ? $_REQUEST["descricao"] : "" ));
			$precoModel->setValor((floatval($_REQUEST["valor"]) ? $_REQUEST["valor"] : "" ));
			$this->retorno = $precoService->precoEdita($precoModel);
			if ($this->retorno == ""){
				echo $this->action->mensagem("Edição efetuada com sucesso!", '', '');
			} else {
				echo $this->action->mensagem($this->retorno, 'erro', '');
			}
		} else if ($acao == "precoExclui") {
			$precoService = new PrecoService();
			$precoModel = new PrecoModel();
			$precoModel->setId(intval( isset($_REQUEST["id"]) ? $_REQUEST["id"] : "" ));
			
			$this->retorno = $precoService->precoExclui($precoModel);
			if ($this->retorno == ""){
				echo $this->action->mensagem("Exclusão efetuada com sucesso!", 'exclui', '');
			} else {
				echo $this->action->mensagem($this->retorno, 'erro', '');
			}
		} else {
			echo $this->action->mensagem('Esta ['.$acao.'] não é uma ação válida!', '', '');
   		}
	}
}
?>