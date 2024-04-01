<?php
require_once ($path_inc . "/classes/conexao/Connect.php");
require_once ($path_inc . "/classes/repository/MovimentacaoRepository.php");
class MovimentacaoService
{
    public function __construct()
    {
    }

    public function collMovimentacao($param)
    {
        global $config;
        $collMovimentacao = array();
        try {
            $Connect = new Connect();
            $conn = $Connect->Open();
            $movimentacaoRepository = new MovimentacaoRepository();
            $rs = $movimentacaoRepository->listAllConst($conn, $param);
            while (!$rs->EOF) {
                $movimentacaoModel = new MovimentacaoModel();
                $movimentacaoModel->setId(intval($rs->fields["id"]));
                $movimentacaoModel->idVeiculo->setId(intval($rs->fields["id_idVeiculo"]));
                $movimentacaoModel->idVeiculo->setPlaca(stripslashes($rs->fields["placa_idVeiculo"]));
                $movimentacaoModel->idVeiculo->idCategoria->setId(intval($rs->fields["id_categoria"]));
                $movimentacaoModel->idVeiculo->idCategoria->setDescricao(stripslashes($rs->fields["descricao_idCategoria"]));
                $movimentacaoModel->idVeiculo->idCategoria->setTaxaPorHora(floatval($rs->fields["taxa_por_hora"]));
                $movimentacaoModel->setDtEntrada(stripslashes($rs->fields["dt_entrada"]));
                $movimentacaoModel->setDtSaida(stripslashes(isset($rs->fields["dt_saida"]) ? $rs->fields["dt_saida"] : " "));
                $movimentacaoModel->setValorCobrado(floatval($rs->fields["valor_cobrado"]));
                $movimentacaoModel->setQtdHoras($this->getDiferencaHoras($movimentacaoModel->getDtEntrada(), $movimentacaoModel->getDtSaida()));
                $collMovimentacao[] = $movimentacaoModel;
                $rs->MoveNext();
            }
            return $collMovimentacao;
        } catch (Exception $e) {
            return "[Bo-Erro]: " . $e->getMessage() . "!";
        }
    }
    public function movimentacaoEntrada($movimentacaoModel)
    {
        global $config;
        try {
            $campoNulo = $this->verificaCampoNulo($movimentacaoModel);
            if ($campoNulo != "") {
                return $campoNulo;
                exit;
            }
            $Connect = new Connect();
            $conn = $Connect->Open();
            $conn->BeginTrans();
            $movimentacaoRepository = new MovimentacaoRepository();
            $param = ["comp" => " and movimentacao.id_veiculo = " . $movimentacaoModel->idVeiculo->getId() . " and movimentacao.dt_saida is null "];
            $rs = $movimentacaoRepository->listAllConst($conn, $param);
            if (!$rs->EOF)
                throw new Exception("Veículo não pode dar entrada pois existe entrada sem uma saída");
            $rs = $movimentacaoRepository->insert($conn, $movimentacaoModel);
            $conn->CommitTrans();
            return "";
        } catch (Exception $e) {
            $conn->rollbackTrans();
            return "[Bo-Erro]: " . $e->getMessage() . "!";
        }
    }
    public function movimentacaoBaixa($movimentacaoModel)
    {
        global $config;
        try {
            $Connect = new Connect();
            $conn = $Connect->Open();
            $conn->BeginTrans();
            $movimentacaoRepository = new MovimentacaoRepository();
            $param = ["comp" => " and movimentacao.id = " . $movimentacaoModel->getId() . " and movimentacao.dt_saida is null "];
            $rs = $movimentacaoRepository->listAllConst($conn, $param);
            if ($rs->EOF)
                throw new Exception("Não existe entrada para este veículo!");
            $dtEntrada = stripslashes($rs->fields["dt_entrada"]);
            $taxaPorHora = floatval($rs->fields["taxa_por_hora"]);
            $movimentacaoModel->setValorCobrado($this->getDiferencaHoras($dtEntrada, $movimentacaoModel->getDtSaida()) * $taxaPorHora);
            $rs = $movimentacaoRepository->efetuarBaixa($conn, $movimentacaoModel);
            $conn->CommitTrans();
            return "";
        } catch (Exception $e) {
            $conn->RollbackTrans();
            return "[Bo-Erro]: " . $e->getMessage() . "!";
        }
    }
    public function verificaCampoNulo($movimentacaoModel)
    {
        $msg = "";
        if ($movimentacaoModel->idVeiculo->getId() == "") {
            $msg .= "O campo Veiculo precisa ser informado!\\n";
        }
        return $msg;
    }
    public function getDiferencaHoras($dtEntrada, $dtSaida)
    {   
        if(trim($dtSaida) == "") return 0;
        $dtEntrada = strtotime($dtEntrada);
        $dtSaida = strtotime($dtSaida);
        $diferencaEmSegundos = $dtSaida - $dtEntrada;
        $diferencaEmHoras = ceil($diferencaEmSegundos / 3600);
        return $diferencaEmHoras;
    }


}
?>