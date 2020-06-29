<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_tiporecurso.php');

//MVC 
// require('../model/mvc/model_mvc_tiporecurso.php');

//DAO
require('../model/DAO/DAO_tiporecurso.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $tipoRec = new SINGLETONTipoRecurso();

//intancia generaL para patron PATRON [mvv]
// $tipoRec = new MVCTipoRecurso();

//instancia para DAO Y VO
$dao = new DAOTipoRecurso();
$tipoRec = new VOTipoRecurso();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $tipoRec->setNombreTipoRec($_POST['nombreTipoRec']);
            // echo $tipoRec->insertData();

            //implementar DAO Y VO
            $tipoRec->setNombreTipoRec($_POST['nombreTipoRec']);
            echo $dao->insertData($tipoRec);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $tipoRec->setId($_POST['id']);
            //   $tipoRec->setNombreTipoRec($_POST['nombreTipoRec']);
            //   echo $tipoRec->updatetData();

             //implementar DAO Y VO
             $tipoRec->setId($_POST['id']);
             $tipoRec->setNombreTipoRec($_POST['nombreTipoRec']);
             echo $dao->updatetData($tipoRec);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $tipoRec->setId($_POST['id']);
            // echo $tipoRec->deleteData();

             //implementar DAO Y VO
             $tipoRec->setId($_POST['id']);
             echo $dao->deleteData($tipoRec);
        break;

        case 'showdata':
    
            //llamda a MVC o singleton
            // echo $tipoRec->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $tipoRec->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}