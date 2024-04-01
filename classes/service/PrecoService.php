<?php
require_once($path_inc."/classes/conexao/Connect.php");
require_once($path_inc."/classes/repository/PrecoRepository.php");

Class PrecoService {

	public function __construct(){
	}

    public function collPreco($param) {
		global $config;
		$collPreco = array();
		try{
			$Connect = new Connect(); 
			$conn = $Connect->Open();
			$precoRepository = new PrecoRepository();
			$rs = $precoRepository->listAllConst($conn,$param);
			while (!$rs->EOF) {
				$precoModel = new PrecoModel();
				$precoModel->setId(intval($rs->fields["id"]));
				$precoModel->setQtdHora(stripslashes($rs->fields["qtd_hora"]));
                $precoModel->setDescricao(stripslashes($rs->fields["descricao"]));
                $precoModel->setValor(stripslashes($rs->fields["valor"]));
				$collPreco[] = $precoModel;
				$rs->MoveNext();
			}
			return $collPreco;
		} catch (Exception $e) {
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}

    public function precoCadastro($precoModel){
		global $config;
		try{
			$campoNulo = $this->verificaCampoNulo($precoModel);
			if ($campoNulo!="") {
				return $campoNulo;
				exit;
			}
			$Connect = new Connect(); $conn = $Connect->Open();
			$conn->BeginTrans();
			$precoRepository = new precoRepository();
			$rs = $precoRepository->insert($conn,$precoModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}

	public function verificaCampoNulo($precoModel){
		$msg = "";
		if ($precoModel->getQtdHora()=="") {
			$msg .= "O campo Quantida de Hora precisa ser informado!\\n";
		}else if($precoModel->getDescricao()==""){
            $msg .= "O campo Descrição precisa ser informado!\\n";
        }else if($precoModel->getValor()==""){
            $msg .= "O campo Valor precisa ser informado!\\n";
        }
		return $msg;
	}

	public function precoExclui($precoModel){
		global $config;
		try{
			$Connect = new Connect(); $conn = $Connect->Open();
			$conn->BeginTrans();
			$precoRepository = new PrecoRepository();
			$rs = $precoRepository->delete($conn,$precoModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}

	public function precoEdita($precoModel){
		global $config;
		try{
			$campoNulo = $this->verificaCampoNulo($precoModel);
			if ($campoNulo!="") {
				return $campoNulo;
				exit;
			}
			$Connect = new Connect(); $conn = $Connect->Open();
			$conn->BeginTrans();
			$precoRepository = new PrecoRepository();
			$rs = $precoRepository->update($conn,$precoModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}
}
?>