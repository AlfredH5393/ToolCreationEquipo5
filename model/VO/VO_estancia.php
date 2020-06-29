<?php
class VOEstancia {
    private $id;
    private $nombreEstancia;
 
    public function setNombreEstancia( $nombreEstancia){
        $this->nombreEstancia = $nombreEstancia;

    }

    public function getNombreEstancia( ){
       return $this->nombreEstancia;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
}