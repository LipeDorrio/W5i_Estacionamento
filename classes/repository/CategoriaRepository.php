<?php
    Class CategoriaRepository {
        public function insert($conn, $obj) {
           $query = "insert into categoria (descricao) 
           values ('".$obj->getDescricao()."')";
           if(!$result = $conn->Execute($query))throw new Exception("[RESPOSITORY]->".$conn->ErrorMsg());
           return $result;
        }
        public function update($conn, $obj){
            $query = "update    categoria 
                        set     categoria.descricao = '".$obj->getDescricao()."' 
                        where   categoria.id = ".$obj->getId()." ";
            if(!$result = $conn->Execute($query))throw new Exception("[RESPOSITORY]->".$conn->ErrorMsg());
            return $result;
        }
        public function delete($conn, $obj){
            $query = "delete 
                        from    categoria 
                        where   categoria.id = '".$obj->getId()." ";
            if(!$result = $conn->Execute($query))throw new Exception("[RESPOSITORY]->".$conn->ErrorMsg());
            return $result;
        }
        public function listAllConst($conn, $param){
            $query = "select categoria.id , categoria.descricao 
                        from categoria where 1=1
                        ".$param["comp"]." 
                        ".$param["orderBy"]." 
                        ".$param["limite"]." ";
            if(!$result = $conn->Execute($query))throw new Exception("[RESPOSITORY]->".$conn->ErrorMsg());
            return $result;
        }
    }
?>