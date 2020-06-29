<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//singleton
require('../model/singleton/model_moneda.php');

//MVC 
// require('../model/mvc/model_mvc_moneda.php');

//DAO Y VO
// require('../model/DAO/DAO_moneda.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//intancia generaL para PATRON[SINGLETON]
$objmoneda = new SINGLETONMoneda();

//intancia generaL para PATRON [mvc]
// $objmoneda = new MVCMoneda();

//instancia para DAO Y VO
// $dao = new DAOMoneda();
// $objmoneda = new VOMoneda();


switch($operacion)
    {
        case 'insert':

            //llamda a MVC singleton
              $objmoneda->setData($_POST['nombreMoneda'], $_POST['valor']);
              echo $objmoneda->insertData();

            //implementar DAO
            // $objmoneda->setNombre($_POST['nombreMoneda']);
            // $objmoneda->setValor($_POST['valor']);
            // echo $dao->insertData($objmoneda);
        break;

        case 'update':

            //llamda a MVC O singleton
              $objmoneda->setId($_POST['id']);
              $objmoneda->setData($_POST['nombreMoneda'], $_POST['valor']);
              echo $objmoneda->updatetData();

             //implementar DAO
            //  $objmoneda->setId($_POST['id']);
            //  $objmoneda->setNombre($_POST['nombreMoneda']);
            //  $objmoneda->setValor($_POST['valor']);
            //  echo $dao->updatetData($objmoneda);
        break;

        case 'delete':

            //llamda a MVC o singleton
            $objmoneda->setId($_POST['id']);
            echo $objmoneda->deleteData();

             //implementar DAO
            //  $objmoneda->setId($_POST['id']);
            //  echo $dao->deleteData($objmoneda);
        break;

        case 'showdata':
             //llamada a singleton a MVC
             echo $objmoneda->getData();

            //implementando DAO
            // echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            echo $objmoneda->countRegister();
            
             //implementando DAO
            // echo $dao->countRegister();
        break;

}