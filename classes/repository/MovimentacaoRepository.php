<?php

class MovimentacaoRepository
{
    public function insert($conn, $obj){
        $query = "insert    into movimentacao (id_veiculo, dt_entrada, dt_saida, valor_cobrado) 
                    values  (" . $obj->idVeiculo->getId() . ",
                            " . $obj->getDtEntrada() . ",
                            " . $obj->getDtSaida() . ",
                            " . $obj->getValorCobrado() . " 
                            )";
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function update($conn, $obj){
        $query = "update    movimentacao 
                    set     movimentacao.id_veiculo = " . $obj->idVeiculo->getId() . ",
                            movimentacao.dt_entrada = '" . $obj->getDtEntrada() . "',
                            movimentacao.dt_saida = '" . $obj->getDtSaida() . "',
                            movimentacao.valor_cobrado = '" . $obj->getValorCobrado() . "'
                    where   movimentacao.id = " . $obj->getId() . " ";
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function delete($conn, $obj){
        $query = "delete    from movimentacao 
                    where   movimentacao.id = ".$obj->getId()." ";
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->". $conn->ErrorMsg());
        return $result;
    }

    public function listAllConst($conn, $param,$obj){
        $query = "select 	movimentacao.id, movimentacao.id_veiculo , movimentacao.dt_entrada, movimentacao.dt_saida, movimentacao.valor_cobrado, 
		                    veiculo.id as id_idVeiculo, 
		                    veiculo.placa as placa_idVeiculo ,
		                    veiculo.id_categoria, categoria.descricao as descricao_idCategoria
                    from 	movimentacao, veiculo, categoria 
                    where 	movimentacao.id_veiculo = veiculo.id 
                    and 	veiculo.id_categoria = categoria.id
                    and 	movimentacao.dt_entrada between ".$obj->getDtEntrada()." and ".$obj->getDtSaida()." ";
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".$conn->ErrorMsg());
        return $result;
    }
}
?>