<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
require('../model/singleton/model_roles.php');

//MVC 
// require('../model/mvc/model_mvc_roles.php');

//DAO
// require('../model/DAO/DAO_rol.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
$objRol = new SINGLETONRoles();

//intancia generaL para patron PATRON [mvv]
// $objRol = new MVCRoles();

//instancia para DAO Y VO
// $dao = new DAORoles();
// $objRol = new VORoles();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            $objRol->setNombreRol($_POST['nombreRol']);
            echo $objRol->insertData();

            //implementar DAO Y VO
            // $objRol->setNombreRol($_POST['nombreRol']);
            // echo $dao->insertData($objRol);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
              $objRol->setId($_POST['id']);
              $objRol->setNombreRol($_POST['nombreRol']);
              echo $objRol->updatetData();

             //implementar DAO Y VO
            //  $objRol->setId($_POST['id']);
            //  $objRol->setNombreRol($_POST['nombreRol']);
            //  echo $dao->updatetData($objRol);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            $objRol->setId($_POST['id']);
            echo $objRol->deleteData();

             //implementar DAO Y VO
            //  $objRol->setId($_POST['id']);
            //  echo $dao->deleteData($objRol);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            echo $objRol->getData();

            //implementando DAO
            // echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            echo $objRol->countRegister();
            
            //  implementando DAO
            // echo $dao->countRegister();
        break;
}