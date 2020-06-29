<?php
class VOPlataforma{
    private $idPlataforma;
    private $nombrePlataforma;
    private $objetivosPlataforma;
    private $metasPlataforma;
    private $misionPlataforma;
    private $visionPlataforma;
    private $descripcionEmpresa;

    //metodos de acceso get
    public function getId(){ return $this->idPlataforma;}
    public function getNombre(){return $this->nombrePlataforma;}
    public function getObjetivos(){return $this->objetivosPlataforma;}
    public function getMetas(){return $this->metasPlataforma;}
    public function getMision(){return $this->misionPlataforma;}
    public function getVision(){return $this->visionPlataforma;}
    public function getDescripcion(){return $this->descripcionEmpresa;}

    //metodos de acceso set
    public function setId($value){  $this->idPlataforma = $value;}
    public function setNombre($value){$this->nombrePlataforma = $value;}
    public function setObjetivos($value){ $this->objetivosPlataforma = $value;}
    public function setMetas($value){ $this->metasPlataforma = $value;}
    public function setMision($value){ $this->misionPlataforma = $value;}
    public function setVision($value){ $this->visionPlataforma = $value;}
    public function setDescripcion($value){ $this->descripcionEmpresa = $value;}

}