<?php
require_once ($path_inc ."/classes/conexao/Connect.php");
require_once ($path_inc ."/classes/model/entity/VeiculoModel.php");
require_once ($path_inc ."/classes/repository/VeiculoRepository.php");
class VeiculoService
{


    public function __construct(){
    }

    public function collVeiculo($param){
        global $config;
        $collVeiculo = array();
        try {
            $Connect = new Connect();
            $conn = $Connect->Open();
            $veiculoRepository = new VeiculoRepository();
            $rs = $veiculoRepository->listAllConst($conn, $param);
            while (!$rs->EOF) {
                $veiculoModel = new VeiculoModel();
                $veiculoModel->setId(intval($rs->fields["id"]));
                $veiculoModel->idCategoria->setId(intval($rs->fields["id_categoria"]));
                $veiculoModel->idCategoria->setDescricao(stripslashes($rs->fields["descricao_IdCategoria"]));
                $veiculoModel->setPlaca(stripslashes($rs->fields["placa"]));
                $collVeiculo[] = $veiculoModel;
                $rs->MoveNext();
            }
            return $collVeiculo;
        } catch (Exception $e) {
            return "[Bp-Erro]: " . $e->getMessage() . "!";
        }
    }
    public function veiculoCadastro($veiculoModel){
        global $config;

        try {
            $campoNulo = $this->verificaCampoNulo($veiculoModel);
            if ($campoNulo != "") {
                return $campoNulo;
                exit;
            }
            $Connect = new Connect();
            $conn = $Connect->Open();
            $conn->BeginTrans();
            $veiculoRepository = new VeiculoRepository();
            $rs = $veiculoRepository->insert($conn, $veiculoModel);
            $conn->CommitTrans();
            return "";
        } catch (Exception $e) {
            $conn->RollbackTrans();
            return "[Bo-Erro]: " . $e->getMessage() . "!";
        }
    }
    public function verificaCampoNulo($veiculoModel){
        $msg = "";
        if($veiculoModel->idCategoria->getId()=="") {
            $msg .= "O campo Categoria precisa ser informado!\\n";    
        }
        return $msg;

    }
    public function veiculoExclui($veiculoModel){
        global $config;
        try {
            $Connect = new Connect();
            $conn = $Connect->Open();
            $veiculoRepository = new VeiculoRepository();
            $rs = $veiculoRepository->delete($conn, $veiculoModel);
            $conn->CommitTrans();
            return "";
        }catch (Exception $e) {
            $conn->RollbackTrans();
            return "[Bo-Erro]: ".$e->getMessage()."!";
        }

    }

    public function veiculoEdita($veiculoModel){
		global $config;
		try{
			$campoNulo = $this->verificaCampoNulo($veiculoModel);
			if ($campoNulo!="") {
				return $campoNulo;
				exit;
			}
			$Connect = new Connect(); $conn = $Connect->Open();
			$conn->BeginTrans();
			$veiculoRepository = new VeiculoRepository();
			$rs = $veiculoRepository->update($conn,$veiculoModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}

}
?>