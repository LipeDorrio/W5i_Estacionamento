<?php
Class PrecoRepository{
    public function insert($conn, $obj){
        $query = "  insert     into preco (qtd_hora, descricao, valor) 
                    values     (".$obj->getQtdHora().",'".$obj->getDescricao()."',".$obj->getValor().")";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }
    public function update($conn, $obj){
        $query = "update    preco 
                     set    preco.qtd_hora = ".$obj->getQtdHora().",
                            preco.descricao = '".$obj->getDescricao()."',
                            preco.valor = ".$obj->getValor()."
                    where   preco.id = ".$obj->getId()." ";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }
    public function delete($conn, $obj){
        $query = "delete from preco where preco.id = ".$obj->getId()." ";
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }
    public function listAllConst($conn, $param){
        $query = "  select  preco.id,  preco.valor, preco.descricao, preco.qtd_hora
                    from    preco
                    where   1=1 ".$param["comp"];
        if(!$result = $conn->Execute($query))throw new Exception("[REPOSITORY]->".mysqli_error($conn));
        return $result;
    }
}
?>