<?php
class VOEstadoTema {
    private $id;
    private $nombreEstadoTema;
 
    public function setNombreEstado( $nombreEstadoTema){
        $this->nombreEstadoTema = $nombreEstadoTema;

    }

    public function getNombreEstado( ){
       return $this->nombreEstadoTema;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
}