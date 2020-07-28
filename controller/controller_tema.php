<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//MVC 
require('../model/mvc/model_mvc_temas.php');

//------------------[Creacion de las instancias de los patrones]------------------------
$tema = new MVCTemas();

switch($operacion){
    case 'insert':
         $tema->setNombre($_POST['nombreTema']);
         $tema->setDescripcion($_POST['descripcion']);
         $tema->setIdCurso($_POST['IDCURSO']);
         echo $tema->insert();

        //  nombreTema: d.getElementById("insert-nombre").value,
        //  descripcion: d.getElementById("insert-descripcion").value,
        //  IDCURSO:  d.getElementById("idCurso").value
        break;
    case 'update':
        $tema->setIdTema($_POST['id']);
        $tema->setNombre($_POST['nombreTema']);
        $tema->setDescripcion($_POST['descripcion']);
        $tema->update();
        break;
    case 'delete':
        $tema->setIdTema($_POST['id']);
        $tema->delete();
        break;
    case 'showdata':
        $tema->setIdCurso($_POST['IDCURSO']);
        echo $tema->getData();
        break;
    case 'count':
         $tema->setIdCurso($_POST['IDCURSO']);
         echo $tema->countRegister();
        break;
}




