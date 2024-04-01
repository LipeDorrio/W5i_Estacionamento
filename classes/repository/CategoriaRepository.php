<?php
class CategoriaRepository
{
    public function insert($conn, $obj)
    {
        $query = "insert into categoria (descricao, taxa_por_hora) 
            values ('" . $obj->getDescricao() . "'," . $obj->getTaxaPorHora() . ")";
        if (!$result = $conn->Execute($query))
            throw new Exception("[RESPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function update($conn, $obj)
    {
        $query = "update    categoria 
                        set     categoria.descricao = '" . $obj->getDescricao() . "',
                                categoria.taxa_por_hora = " . $obj->getTaxaPorHora() . "
                        where   categoria.id = " . $obj->getId() . " ";
        if (!$result = $conn->Execute($query))
            throw new Exception("[RESPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function delete($conn, $obj)
    {
        $query = "delete 
                        from    categoria 
                        where   categoria.id = " . $obj->getId() . "";
        if (!$result = $conn->Execute($query))
            throw new Exception("[RESPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
    public function listAllConst($conn, $param)
    {
        $query = "select categoria.id, categoria.descricao, categoria.taxa_por_hora
                        from categoria where 1=1
                        " . (isset($param["comp"]) ? $param["comp"] : "") . "";
        if (!$result = $conn->Execute($query))
            throw new Exception("[RESPOSITORY]->" . $conn->ErrorMsg());
        return $result;
    }
}
?>