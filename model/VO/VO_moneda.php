<?php
class VOMoneda{
    private $id;
    private $nombreMoneda;
    private $valorMoneda;

    public function getId(){return $this->id;}
    public function getNombre(){return $this->nombreMoneda;}
    public function getValor(){return $this->valorMoneda;}

    public function setId($value){ $this->id = $value;}
    public function setNombre($value){ $this->nombreMoneda = $value;}
    public function setValor($value){ $this->valorMoneda = $value;}

    //EN OTROS LENGUAJES SE . para acceder a las pripiedades o fucniones de la clase
    //EN PHP SE USA ->

}