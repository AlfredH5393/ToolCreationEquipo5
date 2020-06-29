<?php
class VOEstadoUsuario{
    private $id;
    private $nombreEstado;
    private $descripcion;
 
    public function setNombreEstado( $nombreEstado){
        $this->nombreEstado = $nombreEstado;

    }

    public function getNombreEstado( ){
       return $this->nombreEstado;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

    public function getDescripcion(){
      return $this->descripcion;
    }

    public function setDescripcion($descripcion){
         $this->descripcion = $descripcion;
    }
}