<?php
require_once($path_inc."/classes/service/CategoriaService.php");
require_once($path_inc."/classes/model/entity/CategoriaModel.php");
require_once($path_inc."/classes/lib/fwAction.php");

Class CategoriaController {

	public $retorno;
	public $action;
	private $obj;
	public $security;

	public function __construct($acao = null, $param = null) {
		global $caminho;
		$this->action = new ActionAlert();
		
		if ($acao == "categoriaListagem") {
			$obj = new CategoriaService();
			$this->retorno = $obj->collCategoria($param);
			if(!is_array($this->retorno)){
				echo $this->action->mensagem($this->retorno, 'erro', '');
				exit;
			}
		} else if ($acao == "categoriaCadastro") {
			$categoriaService = new CategoriaService();
			$categoriaModel = new CategoriaModel();
			$categoriaModel->setDescricao((isset($_REQUEST["descricao"]) ? $_REQUEST["descricao"] : "" ));
			
			$this->retorno = $categoriaService->categoriaCadastro($categoriaModel);
			if ($this->retorno == ""){
				echo $this->action->mensagem("Cadastro efetuado com sucesso!", '', '');
			} else {
				echo $this->action->mensagem($this->retorno, 'erro', '');
			}
		} else if ($acao == "categoriaEdita") {
			$categoriaService = new CategoriaService();
			$categoriaModel = new CategoriaModel();
			$categoriaModel->setId(intval( isset($_REQUEST["id"]) ? $_REQUEST["id"] : "" ));
			$categoriaModel->setDescricao((isset($_REQUEST["descricao"]) ? $_REQUEST["descricao"] : "" ));
			$this->retorno = $categoriaService->categoriaEdita($categoriaModel);
			if ($this->retorno == ""){
				echo $this->action->mensagem("Edição efetuada com sucesso!", '', '');
			} else {
				echo $this->action->mensagem($this->retorno, 'erro', '');
			}
		} else if ($acao == "categoriaExclui") {
			$categoriaService = new CategoriaService();
			$categoriaModel = new CategoriaModel();
			$categoriaModel->setId(intval( isset($_REQUEST["id"]) ? $_REQUEST["id"] : "" ));
			
			$this->retorno = $categoriaService->categoriaExclui($categoriaModel);
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