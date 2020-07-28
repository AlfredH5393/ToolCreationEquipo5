<?php
require '../model/mvc/conexion.php';
require '../model/mvc/model_mvc_categoria_inst.php';
require '../model/mvc/model_mvc_nivel.php';
require '../model/mvc/model_mvc_moneda.php';
class FacadeOperationDB{
    private $nivel;
    private $moneda;
    private $categoria;

    public function __construct(){
        $this->nivel = new MVCNivel();
        $this->moneda = new MVCMoneda();
        $this->categoria = new MVCCategoriaInstructor();
    }

    public function facadeGetData($optionModule){
        switch($optionModule){
              case 'nivel':
                echo $this->nivel->getData();
              break;
              case 'moneda':
                echo $this->moneda->getData();
              break;
              case 'categoria':
                echo $this->categoria->getData();
              break;
        }
    }   
    
    public function facadeCountRegister($optionModule){
        switch($optionModule){
            case 'nivel':
              echo $this->nivel->countRegister();
            break;
            case 'moneda':
              echo $this->moneda->countRegister();
            break;
            case 'categoria':
              echo $this->categoria->countRegister();
            break;
      }
    }
    
}