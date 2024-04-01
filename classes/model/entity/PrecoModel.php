<?php


Class PrecoModel{
    private $id;
    private $qtdHora;
    private $descricao;
    private $valor;
    
    public function __construct(){
    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getQtdHora(){
        return $this->qtdHora;
    }
    public function setQtdHora($qtdHora){
        $this->qtdHora = $qtdHora;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    public function getValor(){
        return $this->valor;
    }
    public function setValor($valor){
        $this->valor = $valor;
    }


}
?>