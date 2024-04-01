<?php
require_once($path_inc."/classes/model/entity/CategoriaModel.php");

class VeiculoModel
{

    private $id;
    public $idCategoria;
    private $placa;

    public function __construct(){
        $this->idCategoria = new CategoriaModel();
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getPlaca(){
        return $this->placa;
    }

    public function setPlaca($placa){
        $this->placa = $placa;
    }
}
?>