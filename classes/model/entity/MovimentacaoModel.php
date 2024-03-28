<?php

require_once($path_inc."/classes/model/entiy/VeiculoModel.php");
Class MovimentacaoModel{

    private $id;
    private $idVeiculo;

    private $dt_entrada;

    private $dt_saida;

    private $valor_cobrado;

    public function __construct(){
        $this->idVeiculo = new VeiculoModel();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getDt_entrada(){
        return $this->dt_entrada;
    }
    public function setDt_entrada($dt_entrada){
        $this->dt_entrada = $dt_entrada;
    }

    public function getDt_saida(){
        return $this->dt_saida;
    }
    public function setDt_saida($dt_saida){
        $this->dt_saida = $dt_saida;
    }

    public function getValorCobrado(){
        return $this->valor_cobrado;
    }

    public function setValorCobrado($valor_cobrado){
        $this->valor_cobrado = $valor_cobrado;
    }
}
?>
