<?php

Class CategoriaModel{
    private $id;

    private $descricao;

    public function __construct(){
    }
    public function getId($id){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

}
?>
