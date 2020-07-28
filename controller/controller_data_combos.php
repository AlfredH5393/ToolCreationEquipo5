<?php 
require '../model/factory/FactoryProducerCombos.php';
//option para elegir la instancia
$opcionCombo = $_POST['option'];

switch($opcionCombo){
    case 'instanciarCategoria':
        $comboCategoria = ModelFactoryProducerCombos::crearfactory('categoria');
        echo $comboCategoria->getData();
    break;
    
    case 'instanciarNivel':
        $comboNivel = ModelFactoryProducerCombos::crearfactory('nivel');
        echo $comboNivel->getData();
    break;

    case 'instanciarMoneda':
        $comboMoneda = ModelFactoryProducerCombos::crearfactory('moneda');
        echo $comboMoneda->getData();
    break;
    case 'instanciarConocimiento':
        $comboConocimiento = ModelFactoryProducerCombos::crearfactory('conocimiento');
        echo $comboConocimiento->getData();
    break;
    case 'instanciarEstancia':
        $comboEstancia = ModelFactoryProducerCombos::crearfactory('estancia');
        echo $comboEstancia->getData();
    break;
}
