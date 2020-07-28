<?php
$option = $_POST['option'];
//------------------[llamado a los archivos]------------------------
require('../model/mvc/model_mvc_cursos.php');

//------------------[Creacion de las instancias de los patrones]------------------------
$curso = new MVCCurso();

switch($option){
    case 'insert':
        $curso->setNombre($_POST['nombre']);
        $curso->setConocimiento($_POST['conocimiento']);
        $curso->setRequistos($_POST['requisitos']);
        $curso->setDescripcion($_POST['descripcion']);
        $curso->setImagenCurso($_FILES['imgCurso']['name']);
        $curso->setRutaActualImagen($_FILES['imgCurso']['tmp_name']);
        $curso->setCategoria($_POST['categoria']);
        $curso->setNivel($_POST['nivel']);
        $curso->setPrecio($_POST['precio']);
        $curso->setMoneda($_POST['moneda']);
        $curso->setInstructor($_POST['instructor']);
        echo $curso->insertData(); 

        // nombre : d.getElementById('insert-nombre').value,
        //       conocimiento : d.getElementById('insert-conocimiento').value,
        //       requisitos : d.getElementById('insert-requisitos').value,
        //       descripcion : d.getElementById('insert-descripcion').value,
        //       categoria : d.getElementById('combo-categoria').value,
        //       nivel : d.getElementById('combo-nivel').value,
        //       precio : d.getElementById('insert-precio').value,
        //       moneda : d.getElementById('combo-moneda').value,
        //       instructor: d.getElementById('idProfesor').value,
        //       imgCurso : getImgCurso,
    break;
    case 'update':
        $curso->setId($_POST['idCurso']);
        $curso->setNombre($_POST['nombre']);
        $curso->setConocimiento($_POST['conocimiento']);
        $curso->setRequistos($_POST['requisitos']);
        $curso->setDescripcion($_POST['descripcion']);
        $curso->setImagenCurso($_FILES['imgCurso']['name']);
        $curso->setRutaActualImagen($_FILES['imgCurso']['tmp_name']);
        $curso->setCategoria($_POST['categoria']);
        $curso->setNivel($_POST['nivel']);
        $curso->setPrecio($_POST['precio']);
        $curso->setMoneda($_POST['moneda']);
        $curso->updateData();
    break;
    case 'delete':
        $curso->setId($_POST['idCurso']);
        $curso->eliminar();
    break;
    case 'publish':
        $curso->setId($_POST['idCurso']);
        $curso->publicar();
    break;
    case 'restaurar':
        $curso->setId($_POST['idCurso']);
        $curso->restaurar();
    break;
    case 'showData':
        $curso->setInstructor($_POST['idProfesor']);
        echo $curso->showData();
    break;
    case 'showDataCursos':
        echo $curso->showDataCursoClient();
    break;
    case 'showDataCursosDetail':
        $curso->setId($_POST['IDCURSO']);
        echo $curso->cursoDeatail();
    break;
}

