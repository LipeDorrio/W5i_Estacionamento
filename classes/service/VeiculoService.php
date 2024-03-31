<?php
class VeiculoService{
    public function veiculoCadastro($veiculoModel){
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
			$rs = $veiculoRepository->insert($conn,$veiculoModel);
			$conn->CommitTrans();
			return "";
		} catch (Exception $e) {
			$conn->RollbackTrans();
			return "[Bo-Erro]: ".$e->getMessage()."!";
		}
	}
}
?>