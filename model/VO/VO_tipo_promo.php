<?php
class VOTipoPromo{
    private $nombreTipoPromocion;
    private $id;

    public function setNombreTipoPromocion( $value){  $this->nombreTipoPromocion = $value;  }
    public function getNombreTipoPromocion(){ return $this->nombreTipoPromocion; }
    public function setId( $id ){ $this->id = $id; }
    public function getId(){ return $this->id; }
    
}