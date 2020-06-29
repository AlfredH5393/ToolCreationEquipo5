<?php
class VONivel{
    private $id;
    private $nivel;
 
    public function setNombreNivel( $nivel ){
        $this->nivel = $nivel;
    }

    public function getNombreNivel(){
       return $this->nivel;
    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
}
