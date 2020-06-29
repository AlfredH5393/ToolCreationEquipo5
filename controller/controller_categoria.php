<?php
$operacion = $_POST['option'];
//------------------[llamado a los archivos]------------------------
//SINGLETON
// require('../model/singleton/model_categoria_curso.php');

//MVC 
// require('../model/mvc/model_mvc_categoria_inst.php');

//DAO
require('../model/DAO/DAO_categoria.php');

//------------------[Creacion de las instancias de los patrones]------------------------

//instancia de [singleton]
// $objCategoria = new SINGLETONCategoria();

//intancia generaL para patron PATRON [mvv]
// $objCategoria = new MVCCategoriaInstructor();

//instancia para DAO Y VO
$dao = new DAOCategoria();
$objCategoria = new VOCategoriaInst();


switch($operacion)
    {
        case 'insert':
            //llamada a SINGLETON O MVC
            // $objCategoria->setNombreCategoria($_POST['nombreCategoria']);
            // echo $objCategoria->insertData();

            //implementar DAO Y VO
            $objCategoria->setNombreCategoria($_POST['nombreCategoria']);
            echo $dao->insertData($objCategoria);
        break;

        case 'update':
            //llamada a SINGLETON O MVC
            //   $objCategoria->setId($_POST['id']);
            //   $objCategoria->setNombreCategoria($_POST['nombreCategoria']);
            //   echo $objCategoria->updatetData();

             //implementar DAO Y VO
             $objCategoria->setId($_POST['id']);
             $objCategoria->setNombreCategoria($_POST['nombreCategoria']);
             echo $dao->updatetData($objCategoria);
        break;

        case 'delete':
             //llamada a SINGLETON O MVC
            // $objCategoria->setId($_POST['id']);
            // echo $objCategoria->deleteData();

             //implementar DAO Y VO
             $objCategoria->setId($_POST['id']);
             echo $dao->deleteData($objCategoria);
        break;

        case 'showdata':

            //llamda a MVC Y SINGLETON
            // echo $objCategoria->getData();

            //implementando DAO
            echo $dao->getData();
        break;
        case 'count':
            //implmentacio de singleton y MVC
            // echo $objCategoria->countRegister();
            
            //  implementando DAO
            echo $dao->countRegister();
        break;
}