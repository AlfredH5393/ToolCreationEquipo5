<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_tipovideo.php');

//MVC 
// require('../model/mvc/model_mvc_tipovideo.php');

//DAO
require('../model/DAO/DAO_tipovideo.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $tipoVideo = new SINGLETONTipoVideo();

//intancia generaL para patron PATRON [mvv]
// $tipoVideo = new MVCTipoVideo();

//instancia para DAO Y VO
$dao = new DAOTipoVideo();
$tipoVideo = new VOTipoVideo();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $tipoVideo->setNombreTipoVideo($_POST['nombreTipoVid']);
            // echo $tipoVideo->insertData();

            //implementar DAO Y VO
            $tipoVideo->setNombreTipoVideo($_POST['nombreTipoVid']);
            echo $dao->insertData($tipoVideo);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $tipoVideo->setId($_POST['id']);
            //   $tipoVideo->setNombreTipoVideo($_POST['nombreTipoVid']);
            //   echo $tipoVideo->updatetData();

             //implementar DAO Y VO
             $tipoVideo->setId($_POST['id']);
             $tipoVideo->setNombreTipoVideo($_POST['nombreTipoVid']);
             echo $dao->updatetData($tipoVideo);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $tipoVideo->setId($_POST['id']);
            // echo $tipoVideo->deleteData();

             //implementar DAO Y VO
             $tipoVideo->setId($_POST['id']);
             echo $dao->deleteData($tipoVideo);
        break;

        case 'showdata':
    
            //llamda a MVC o singleton
            // echo $tipoVideo->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $tipoVideo->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}