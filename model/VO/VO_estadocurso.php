<?php
class VOEstadoCurso{
    private $id;
    private $nombreEstadoCurso;
 
    public function setNombreEstadoCurso( $nombreEstadoCurso){
        $this->nombreEstadoCurso = $nombreEstadoCurso;

    }

    public function getNombreEstadoCurso( ){
       return $this->nombreEstadoCurso;
    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
}