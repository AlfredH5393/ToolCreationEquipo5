<?php
class VOTipoRecurso{
    
    private $id;
    private $nombreTipoRec;
   
 
    public function setNombreTipoRec( $nombreTipoRec){
        $this->nombreTipoRec = $nombreTipoRec;

    }

    public function getNombreTipoRec( ){
       return $this->nombreTipoRec;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

}