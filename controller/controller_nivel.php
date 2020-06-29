<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_nivel.php');

//MVC 
// require('../model/mvc/model_mvc_nivel.php');

//DAO
require('../model/DAO/DAO_nivel.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $nivel = new SINGLETONNivel();

//intancia generaL para patron PATRON [mvv]
// $nivel = new MVCNivel();

//instancia para DAO Y VO
$dao = new DAONivel();
$nivel = new VONivel();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $nivel->setNombreNivel($_POST['nombreNivel']);
            // echo $nivel->insertData();

            //implementar DAO Y VO
            $nivel->setNombreNivel($_POST['nombreNivel']);
            echo $dao->insertData($nivel);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $nivel->setId($_POST['id']);
            //   $nivel->setNombreNivel($_POST['nombreNivel']);
            //   echo $nivel->updatetData();

             //implementar DAO Y VO
             $nivel->setId($_POST['id']);
             $nivel->setNombreNivel($_POST['nombreNivel']);
             echo $dao->updatetData($nivel);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $nivel->setId($_POST['id']);
            // echo $nivel->deleteData();

             //implementar DAO Y VO
             $nivel->setId($_POST['id']);
             echo $dao->deleteData($nivel);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            // echo $nivel->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $nivel->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}