<?php

Class CategoriaModel{

    private $id;
    private $descricao;
    private $taxaPorHora;

    public function __construct(){
    }
    public function getId(){
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

    public function getTaxaPorHora(){
        return $this->taxaPorHora;
    }
    public function setTaxaPorHora($taxaPorHora){
        $this->taxaPorHora = $taxaPorHora;
    }

}
?>
