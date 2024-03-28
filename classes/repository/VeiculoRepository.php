<?php
class VeiculoRepository
{
    public function insert($conn, $obj){
        $query = "insert into veiculo (id_categoria, placa) values (" . $obj->idCategoria->getId() . ",
            " . $obj->getPlaca() . ",)";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->". $conn->ErrorMsg());
        return $result;
    }
    public function update($conn, $obj){
        $query = "update    veiculo 
                    set     veiculo.id_categoria = ". $obj->idCategoria->getId()."
                            veiculo.placa = ".$obj->getPlaca()."
                    where   veiculo.id = ".$obj->getId()." ";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->". $conn->ErrorMsg());
        return $result;
    }
    public function delete($conn, $obj){
        $query = "delete from veiculo where veiculo.id = ". $obj->getId()." ";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->". $conn->ErrorMsg());
        return $result;
    }
    public function listAllConst($conn, $param){
        $query = "  select veiculo.id, veiculo.id_categoria, veiculo.placa, categoria.id as id_idCategoria,
                    categoria.descricao as descricao_IdCategoria , 
                    from  veiculo,
                    categoria";
    }

}
?>