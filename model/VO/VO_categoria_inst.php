<?php
class VOCategoriaInst{
    
    private $id;
    private $nombreCategoria;
    //EN OTROS LENGUAJES SE . para acceder a las pripiedades o fucniones de la clase
    //EN PHP SE USA ->

    public function setNombreCategoria( $nombreCategoria){
        $this->nombreCategoria = $nombreCategoria;

    }

    public function getNombreCategoria( ){
       return $this->nombreCategoria;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

}