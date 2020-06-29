<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_estadousuario.php');

//MVC 
// require('../model/mvc/model_mvc_estadousuario.php');

//DAO
require('../model/DAO/DAO_estadousuario.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $objEstadoUsuario = new SINGLETONEstadoUsuario();

//intancia generaL para patron PATRON [mvv]
// $objEstadoUsuario = new MVCEstadoUsuario();

//instancia para DAO Y VO
$dao = new DAOEstadoUsuario();
$objEstadoUsuario = new VOEstadoUsuario();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $objEstadoUsuario->setNombreEstado($_POST['nombreEstadoUsuario']);
            // $objEstadoUsuario->setDescripcion($_POST['descripcion']);
            // echo $objEstadoUsuario->insertData();

            //implementar DAO Y VO
            $objEstadoUsuario->setNombreEstado($_POST['nombreEstadoUsuario']);
            $objEstadoUsuario->setDescripcion($_POST['descripcion']);
            echo $dao->insertData($objEstadoUsuario);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $objEstadoUsuario->setId($_POST['id']);
            //   $objEstadoUsuario->setNombreEstado($_POST['nombreEstadoUsuario']);
            //   $objEstadoUsuario->setDescripcion($_POST['descripcion']);
            //   echo $objEstadoUsuario->updatetData();

             //implementar DAO Y VO
             $objEstadoUsuario->setId($_POST['id']);
                $objEstadoUsuario->setNombreEstado($_POST['nombreEstadoUsuario']);
                $objEstadoUsuario->setDescripcion($_POST['descripcion']);
             echo $dao->updatetData($objEstadoUsuario);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $objEstadoUsuario->setId($_POST['id']);
            // echo $objEstadoUsuario->deleteData();

             //implementar DAO Y VO
             $objEstadoUsuario->setId($_POST['id']);
             echo $dao->deleteData($objEstadoUsuario);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            // echo $objEstadoUsuario->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $objEstadoUsuario->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}