<?php
class PrecoRepository{
    public function insert($conn, $obj){
        $query = "  insert     into preco (valor, descricao) 
                    values     (".$obj->getValor()." ".$obj->getDescricao().")";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }
    public function update($conn, $obj){
        $query = "update    preco 
                     set    preco.valor = ".$obj->getValor().",
                            preco.descricao = ".$obj->getDescricao()." 
                    where   preco.id = ".$obj->getId()." ";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }
    public function delete($conn, $obj){
        $query = "delete from preco where preco.id = ".$obj->getId()." ";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }
    public function listAllConst($conn, $param,$obj){
        $query = "  select  preco.id,  preco.valor, preco.descricao as id_idPreco 
                    from    preco
                    where preco.id = ".$obj->getId()." ";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }

}
?>