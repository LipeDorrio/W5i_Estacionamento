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
        if (!$result = $conn->Execute($query))
            throw new Exception("[REPOSITORY]->" . $conn->ErrorMsg());
    }
    public function update($conn, $obj){
        $query = "update    movimentacao 
                    set     movimentacao.id_veiculo = " . $obj->idVeiculo->getId() . ",
                            movimentacao.dt_entrada = '" . $obj->getDtEntrada() . "',
                            movimentacao.dt_saida = '" . $obj->getDtSaida() . "',
                            movimentacao.valor_cobrado = '" . $obj->getValorCobrado() . "'
                    where   movimentacao.id = " . $obj->getId() . " ";
        if (!$result = $conn->Execute($query))
            throw new Exception("[REPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function delete($conn, $obj){
        $query = "delete    from movimentacao 
                    where   movimentacao.id = ".$obj->getId()." ";
        if (!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->". $conn->ErrorMsg());
        return $result;
    }

    public function listAllConst($conn, $param){
        $query = "select movimentacao.id, movimentacao.id_veiculo, veiculo.id as id_Idveiculo, 
                  ";
    }
}
?>