<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_estadotema.php');

//MVC 
// require('../model/mvc/model_mvc_estadotema.php');

//DAO
require('../model/DAO/DAO_estadotema.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $objEstadoTema = new SINGLETONEstadoTema();

//intancia generaL para patron PATRON [mvv]
// $objEstadoTema = new MVCEstadoTema();

//instancia para DAO Y VO
$dao = new DAOEstadoTema();
$objEstadoTema = new VOEstadoTema();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $objEstadoTema->setNombreEstado($_POST['nombreEstadoTema']);
            // echo $objEstadoTema->insertData();

            //implementar DAO Y VO
            $objEstadoTema->setNombreEstado($_POST['nombreEstadoTema']);
            echo $dao->insertData($objEstadoTema);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $objEstadoTema->setId($_POST['id']);
            //   $objEstadoTema->setNombreEstado($_POST['nombreEstadoTema']);
            //   echo $objEstadoTema->updatetData();

             //implementar DAO Y VO
             $objEstadoTema->setId($_POST['id']);
                $objEstadoTema->setNombreEstado($_POST['nombreEstadoTema']);
             echo $dao->updatetData($objEstadoTema);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $objEstadoTema->setId($_POST['id']);
            // echo $objEstadoTema->deleteData();

             //implementar DAO Y VO
             $objEstadoTema->setId($_POST['id']);
             echo $dao->deleteData($objEstadoTema);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            // echo $objEstadoTema->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $objEstadoTema->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}