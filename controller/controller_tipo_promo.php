<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
require('../model/singleton/model_tipopromo.php');

//MVC 
// require('../model/mvc/model_mvc_tipopromo.php');

//DAO
// require('../model/DAO/DAO_tipopromo.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
$objTipoPromo = new SINGLETONTipoPromocion();

//intancia generaL para patron PATRON [mvv]
// $objTipoPromo = new MVCTipoPromocion();

//instancia para DAO Y VO
// $dao = new DAOTipoPromocion();
// $objTipoPromo = new VOTipoPromo();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            $objTipoPromo->setNombreTipoPromocion($_POST['nombreTipoPromo']);
            echo $objTipoPromo->insertData();

            //implementar DAO Y VO
            // $objTipoPromo->setNombreTipoPromocion($_POST['nombreTipoPromo']);
            // echo $dao->insertData($objTipoPromo);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
              $objTipoPromo->setId($_POST['id']);
              $objTipoPromo->setNombreTipoPromocion($_POST['nombreTipoPromo']);
              echo $objTipoPromo->updatetData();

             //implementar DAO Y VO
            //  $objTipoPromo->setId($_POST['id']);
            //  $objTipoPromo->setNombreTipoPromocion($_POST['nombreTipoPromo']);
            //  echo $dao->updatetData($objTipoPromo);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            $objTipoPromo->setId($_POST['id']);
            echo $objTipoPromo->deleteData();

             //implementar DAO Y VO
            //  $objTipoPromo->setId($_POST['id']);
            //  echo $dao->deleteData($objTipoPromo);
        break;

        case 'showdata':
    
            //llamda a MVC o singleton
            echo $objTipoPromo->getData();

            //implementando DAO
            // echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            echo $objTipoPromo->countRegister();
            
            //  implementando DAO
            // echo $dao->countRegister();
        break;
}