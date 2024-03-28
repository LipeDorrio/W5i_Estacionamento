<?php

require_once($path_inc."/classes/model/entiy/VeiculoModel.php");
Class MovimentacaoModel{

    private $id;
    public $idVeiculo;
    private $dtEntrada;
    private $dtSaida;
    private $valorCobrado;

    public function __construct(){
        $this->idVeiculo = new VeiculoModel();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getDtEntrada(){
        return $this->dtEntrada;
    }
    public function setDtEntrada($dtEntrada){
        $this->dtEntrada = $dtEntrada;
    }

    public function getDtSaida(){
        return $this->dtSaida;
    }
    public function setDtSaida($dtSaida){
        $this->dtSaida = $dtSaida;
    }

    public function getValorCobrado(){
        return $this->valorCobrado;
    }

    public function setValorCobrado($valorCobrado){
        $this->valorCobrado = $valorCobrado;
    }
}
?>
