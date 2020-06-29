<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_estancia.php');

//MVC 
// require('../model/mvc/model_mvc_estancia.php');

//DAO
require('../model/DAO/DAO_estancia.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $objEstancia = new SINGLETONEstancia();

//intancia generaL para patron PATRON [mvv]
// $objEstancia = new MVCEstancia();

//instancia para DAO Y VO
$dao = new DAOEstancia();
$objEstancia = new VOEstancia();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $objEstancia->setNombreEstancia($_POST['nombreEstancia']);
            // echo $objEstancia->insertData();

            //implementar DAO Y VO
            $objEstancia->setNombreEstancia($_POST['nombreEstancia']);
            echo $dao->insertData($objEstancia);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $objEstancia->setId($_POST['id']);
            //   $objEstancia->setNombreEstancia($_POST['nombreEstancia']);
            //   echo $objEstancia->updatetData();

             //implementar DAO Y VO
             $objEstancia->setId($_POST['id']);
             $objEstancia->setNombreEstancia($_POST['nombreEstancia']);
             echo $dao->updatetData($objEstancia);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $objEstancia->setId($_POST['id']);
            // echo $objEstancia->deleteData();

             //implementar DAO Y VO
             $objEstancia->setId($_POST['id']);
             echo $dao->deleteData($objEstancia);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            // echo $objEstancia->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $objEstancia->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}