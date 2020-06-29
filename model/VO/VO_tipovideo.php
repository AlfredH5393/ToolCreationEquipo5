<?php
class VOTipoVideo {
    private $id;
    private $nombreTipoVideo;
   
    public function setNombreTipoVideo( $nombreTipoVideo){
        $this->nombreTipoVideo = $nombreTipoVideo;
    }

    public function getNombreTipoVideo(){
       return $this->nombreTipoVideo;
    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
}