<?php

class MovimentacaoRepository
{
    public function insert($conn, $obj){
        $query = "insert    into movimentacao (id_veiculo, dt_entrada) 
                    values  (" . $obj->idVeiculo->getId() . ",
                            '" . $obj->getDtEntrada() . "')";
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function efetuarBaixa($conn, $obj){
        $query = "update    movimentacao 
                    set     movimentacao.dt_saida = '" . $obj->getDtSaida() . "',
                            movimentacao.valor_cobrado = '" . $obj->getValorCobrado() . "'
                    where   movimentacao.id = " . $obj->getId() . " ";
        echo $query;
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function listAllConst($conn, $param){
        $query = "select 	movimentacao.id, movimentacao.id_veiculo , movimentacao.dt_entrada, movimentacao.dt_saida, movimentacao.valor_cobrado, 
		                    veiculo.id as id_idVeiculo, 
		                    veiculo.placa as placa_idVeiculo ,
		                    veiculo.id_categoria, categoria.descricao as descricao_idCategoria,
                            categoria.taxa_por_hora
                    from 	movimentacao, veiculo, categoria 
                    where 	movimentacao.id_veiculo = veiculo.id 
                    and 	veiculo.id_categoria = categoria.id
                        " . (isset($param["comp"]) ? $param["comp"] : "") . " 
                    order by movimentacao.dt_entrada desc";
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".$conn->ErrorMsg());
        return $result;
    }
}
?>