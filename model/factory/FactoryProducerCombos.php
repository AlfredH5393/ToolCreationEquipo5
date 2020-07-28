<?php
require '../model/mvc/conexion.php';
require '../model/mvc/model_mvc_categoria_inst.php';
require '../model/mvc/model_mvc_nivel.php';
require '../model/mvc/model_mvc_moneda.php';
require '../model/mvc/model_mvc_estancia.php';
require '../model/mvc/model_mvc_grado_conocimiento.php';

class ModelFactoryProducerCombos{
    public static function crearfactory( $combo){
        $facoryObeject;

        switch ($combo) {
            case 'categoria':
                 $facoryObeject = new MVCCategoriaInstructor();
                break;
            case 'nivel':
                 $facoryObeject = new MVCNivel();
                break;
            case 'moneda':
                 $facoryObeject = new MVCMoneda();
                break;
           case 'conocimiento':
                    $facoryObeject = new MVCGradoConocimiento();
                   break;
            case 'estancia':
                $facoryObeject = new MVCEstancia();
                break;
        }

        return $facoryObeject;
    }
}

