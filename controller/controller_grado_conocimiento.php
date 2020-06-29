<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_grado_conocimiento.php');

//MVC 
// require('../model/mvc/model_mvc_grado_conocimiento.php');

//DAO
require('../model/DAO/DAO_grado_conocimiento.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $objGradoConocimiento = new SINGLETONGradoConocimiento();

//intancia generaL para patron PATRON [mvv]
// $objGradoConocimiento = new MVCGradoConocimiento();

//instancia para DAO Y VO
$dao = new DAOGradoConocimiento();
$objGradoConocimiento = new VOGradoConocimiento();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $objGradoConocimiento->setNombreGradoConocimiento($_POST['nombreGrado']);
            // echo $objGradoConocimiento->insertData();

            //implementar DAO Y VO
            $objGradoConocimiento->setNombreGradoConocimiento($_POST['nombreGrado']);
            echo $dao->insertData($objGradoConocimiento);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $objGradoConocimiento->setId($_POST['id']);
            //   $objGradoConocimiento->setNombreGradoConocimiento($_POST['nombreGrado']);
            //   echo $objGradoConocimiento->updatetData();

             //implementar DAO Y VO
             $objGradoConocimiento->setId($_POST['id']);
             $objGradoConocimiento->setNombreGradoConocimiento($_POST['nombreGrado']);
             echo $dao->updatetData($objGradoConocimiento);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $objGradoConocimiento->setId($_POST['id']);
            // echo $objGradoConocimiento->deleteData();

             //implementar DAO Y VO
             $objGradoConocimiento->setId($_POST['id']);
             echo $dao->deleteData($objGradoConocimiento);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            // echo $objGradoConocimiento->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $objGradoConocimiento->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}