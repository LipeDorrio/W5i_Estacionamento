<?php


require_once($path_inc."/classes/model/entity/CategoriaModel.php");

class VeiculoModel
{

    private $id;
    private $id_categoria;
    private $placa;

    public function __construct(){
        $this->id_categoria = new CategoriaModel();
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