<?php
require '../model/facade/facade_operation_db.php';
$facadeOperationDb = new FacadeOperationDB();
$optionFuncion = $_POST['functionFacade'];
// $optionFuncion = "getData";
$optionModule = $_POST['mudule']; 
// $optionModule = "nivel"; 

switch($optionFuncion){
    case 'getData':
            $facadeOperationDb->facadeGetData($optionModule);
        break;

    case 'contRegister':
           $facadeOperationDb->facadeCountRegister($optionModule);
        break;
}
