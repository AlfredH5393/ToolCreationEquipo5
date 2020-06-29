<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_estadocurso.php');

//MVC 
// require('../model/mvc/model_mvc_estadocurso.php');

//DAO
require('../model/DAO/DAO_estadocurso.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $estadoCurso = new SINGLETONEstadoCurso();

//intancia generaL para patron PATRON [mvv]
// $estadoCurso = new MVCEstadoCurso();

//instancia para DAO Y VO
$dao = new DAOEstadoCurso();
$estadoCurso = new VOEstadoCurso();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $estadoCurso->setNombreEstadoCurso($_POST['nombreEstadoCurso']);
            // echo $estadoCurso->insertData();

            //implementar DAO Y VO
            $estadoCurso->setNombreEstadoCurso($_POST['nombreEstadoCurso']);
            echo $dao->insertData($estadoCurso); 
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $estadoCurso->setId($_POST['id']);
            //   $estadoCurso->setNombreEstadoCurso($_POST['nombreEstadoCurso']);
            //   echo $estadoCurso->updatetData();

             //implementar DAO Y VO
             $estadoCurso->setId($_POST['id']);
             $estadoCurso->setNombreEstadoCurso($_POST['nombreEstadoCurso']);
             echo $dao->updatetData($estadoCurso);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $estadoCurso->setId($_POST['id']);
            // echo $estadoCurso->deleteData();

             //implementar DAO Y VO
             $estadoCurso->setId($_POST['id']);
             echo $dao->deleteData($estadoCurso);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            // echo $estadoCurso->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $estadoCurso->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}