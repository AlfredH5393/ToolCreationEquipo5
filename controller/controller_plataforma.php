<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//llamado a singleton
require('../model/singleton/model_plataforma.php');

//llamado a MVC
// require('../model/mvc/model_mvc_plataforma.php');

//DAO
// require('../model/DAO/DAO_plataforma.php');

//------------------[Creacion de las instancias de los patrones]------------------------


//INSTANCIA PARA PATRON [ SINGLETON]
$plataforma = new SINGLETONPlataforma();

//INSTANCIA PARA PATRON [ MVC]
//  $plataforma = new MVCPlataforma();

//PATRON PARA VO y DAO
// $dao = new DAOPlataforma();
// $plataforma = new VOPlataforma();

switch($operacion)
    {
        case 'insert':
           
            
            //instancia  a mvc
            $plataforma->setData($_POST['nombre'], $_POST['objetivos'], $_POST['metas'], $_POST['mision'] , $_POST['vision'], $_POST['descripcion']);
            echo $plataforma->insertData();

            //implemetando DAO
            // $plataforma->setNombre($_POST['nombre']); 
            // $plataforma->setObjetivos($_POST['objetivos']);
            // $plataforma->setMetas( $_POST['metas']);
            // $plataforma->setMision($_POST['mision']);
            // $plataforma->setVision($_POST['vision']);
            // $plataforma->setDescripcion($_POST['descripcion']);
            // echo $dao->insertData($plataforma);

        break;

        case 'update':
             //instancia  a mvc a SINGLEON
             $plataforma->setId($_POST['id']);
             $plataforma->setData($_POST['nombre'], $_POST['objetivos'], $_POST['metas'], $_POST['mision'] , $_POST['vision'], $_POST['descripcion']);
             echo $plataforma->updatetData();

            
            //implemetando DAO Y VO
            // $plataforma->setId($_POST['id']);
            // $plataforma->setNombre($_POST['nombre']); 
            // $plataforma->setObjetivos($_POST['objetivos']);
            // $plataforma->setMetas( $_POST['metas']);
            // $plataforma->setMision($_POST['mision']);
            // $plataforma->setVision($_POST['vision']);
            // $plataforma->setDescripcion($_POST['descripcion']);
            // echo $dao->updatetData($plataforma);
        break;

        case 'delete':
            
             //instancia  a mvc O SINGLETON
             $plataforma->setId($_POST['id']);
             echo $plataforma->deleteData();

            //implemetando DAO y VO
            // $plataforma->setId($_POST['id']);
            // echo $dao->deleteData($plataforma);

        break;

        case 'showdata':
            //instancia  a singleton, mvc
            echo $plataforma->getData();

            //Instacia a DAO
            // echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            echo $plataforma->countRegister();
            
             //implementando DAO
            // echo $dao->countRegister();
        break;

}