<?php
class VOGradoConocimiento {
    private $id;
    private $nombreGradoConocimiento;
 
    public function setNombreGradoConocimiento( $nombreGradoConocimiento){
        $this->nombreGradoConocimiento = $nombreGradoConocimiento;

    }

    public function getNombreGradoConocimiento( ){
       return $this->nombreGradoConocimiento;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
}