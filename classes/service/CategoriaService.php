<?php
require_once($path_inc."/classes/conexao/Connect.php");
require_once($path_inc."/classes/repository/CategoriaRepository.php");

Class CategoriaService {

	public function __construct(){
	}

    public function collCategoria($param) {
		global $config;
		$collCategoria = array();
		try{
			$Connect = new Connect(); $conn = $Connect->Open();
			$categoriaRepository = new CategoriaRepository();
			$rs = $categoriaRepository->listAllConst($conn,$param);
			while (!$rs->EOF) {
				$categoriaModel = new CategoriaModel();
				$categoriaModel->setId(intval($rs->fields["id"]));
				$categoriaModel->setDescricao(stripslashes($rs->fields["descricao"]));
				$collCategoria[] = $categoriaModel;
				$rs->MoveNext();
			}
			return $collCategoria;
		} catch (Exception $e) {
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}

    public function categoriaCadastro($categoriaModel){
		global $config;
		try{
			$campoNulo = $this->verificaCampoNulo($categoriaModel);
			if ($campoNulo!="") {
				return $campoNulo;
				exit;
			}
			$Connect = new Connect(); $conn = $Connect->Open();
			$conn->BeginTrans();
			$categoriaRepository = new CategoriaRepository();
			$rs = $categoriaRepository->insert($conn,$categoriaModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}

	public function verificaCampoNulo($categoriaModel){
		$msg = "";
		if ($categoriaModel->getDescricao()=="") {
			$msg .= "O campo descricao precisa ser informado!\\n";
		}
		return $msg;
	}

	public function categoriaExclui($categoriaModel){
		global $config;
		try{
			$Connect = new Connect(); $conn = $Connect->Open();
			$conn->BeginTrans();
			$categoriaRepository = new CategoriaRepository();
			$rs = $categoriaRepository->delete($conn,$categoriaModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}

	public function categoriaEdita($categoriaModel){
		global $config;
		try{
			$campoNulo = $this->verificaCampoNulo($categoriaModel);
			if ($campoNulo!="") {
				return $campoNulo;
				exit;
			}
			$Connect = new Connect(); $conn = $Connect->Open();
			$conn->BeginTrans();
			$categoriaRepository = new CategoriaRepository();
			$rs = $categoriaRepository->update($conn,$categoriaModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}
}
?>