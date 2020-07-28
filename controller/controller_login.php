<?php 
$option = $_POST['option'];
//------------------[llamado a los archivos]------------------------
require('../model/mvc/model_mvc_login.php');


//------------------[Creacion de las instancias de los patrones]------------------------
$login = new MVCLogin();
// $option = 'autenticacion';

switch ($option) {
    case 'autenticacion':
            $login->setEmail($_POST['email']);
            $login->setPassword($_POST['password']);

            // $login->setEmail('almagr@gmail.com');
            // $login->setPassword('12345');

            $rol = $login->obtenerPasswordAndRol();
            $arrayListDataUser = $login->autenticacion();

            if($arrayListDataUser[0] == 0){
                echo '0';
            }else if($arrayListDataUser[0] == false){
                echo 'NA';
            }else{
                session_start();
               
                $_SESSION['ingreso'] = 'YES';
                $_SESSION['status']  = 'activo';
                if($rol[1] == 11){
                  
                    $_SESSION['ID_usuario']    = $arrayListDataUser[0];
                    $_SESSION['ID_Estudiante'] = $arrayListDataUser[1];
                    $_SESSION['nombre']        = $arrayListDataUser[2];
                    $_SESSION['APaterno']      = $arrayListDataUser[3];
                    $_SESSION['AMaterno']      = $arrayListDataUser[4];
                    $_SESSION['FNacimiento']   = $arrayListDataUser[5];
                    $_SESSION['edad']          = $arrayListDataUser[6];
                    $_SESSION['sexo']          = $arrayListDataUser[7];
                    $_SESSION['email']         = $arrayListDataUser[8];
                    $_SESSION['telefono']      = $arrayListDataUser[9];
                    $_SESSION['usuario']       = $arrayListDataUser[10];
                    $_SESSION['password']      = $arrayListDataUser[11];
                    $_SESSION['estado_user']   = $arrayListDataUser[12];
                    $_SESSION['idPlataforma']  = $arrayListDataUser[13];
                    $_SESSION['idRol']         = $arrayListDataUser[14];
                    $_SESSION['imagen']        = $arrayListDataUser[15];
                    $_SESSION['nombreRol']     = $arrayListDataUser[16];
                    echo $arrayListDataUser[14];
                    
                }else{
                
                    $_SESSION['ID_usuario']    = $arrayListDataUser[0];
                    $_SESSION['nombre']        = $arrayListDataUser[1];
                    $_SESSION['APaterno']      = $arrayListDataUser[2];
                    $_SESSION['AMaterno']      = $arrayListDataUser[3];
                    $_SESSION['FNacimiento']   = $arrayListDataUser[4];
                    $_SESSION['edad']          = $arrayListDataUser[5];
                    $_SESSION['sexo']          = $arrayListDataUser[6];
                    $_SESSION['email']         = $arrayListDataUser[7];
                    $_SESSION['telefono']      = $arrayListDataUser[8];
                    $_SESSION['usuario']       = $arrayListDataUser[9];
                    $_SESSION['password']      = $arrayListDataUser[10];
                    $_SESSION['estado_user']   = $arrayListDataUser[11];
                    $_SESSION['idPlataforma']  = $arrayListDataUser[12];
                    $_SESSION['idRol']         = $arrayListDataUser[13];
                    $_SESSION['imagen']        = $arrayListDataUser[14];
                    $_SESSION['nombreRol']     = $arrayListDataUser[15];
                    echo $arrayListDataUser[13];
                    
                }
               
            }
        break;
    case 'register':
            $login->setNombre($_POST['nombre']);
            $login->setApaterno($_POST['AP']);
            $login->setAmaterno($_POST['AM']);
            $login->setFechaNacimiento($_POST['dateOfBirth']);
            $login->setEdad($_POST['edad']);
            $login->setSexo($_POST['sexo']);
            $login->setEmail($_POST['email']);
            $login->setUsuario($_POST['usuario']);
            $login->setPassword($_POST['password']);
            $login->setEstadoUsuario(1);
            $login->setPlataforma(1);
            $login->setRol(11);

            echo $login->register();

        break;
    case 'accountConfig':
            $login->setTelefono($_REQUEST['telefono']);
            $login->setNombre($_REQUEST['nombre']);
            $login->setApaterno($_REQUEST['AP']);
            $login->setAmaterno($_REQUEST['AM']);
            $login->setFechaNacimiento($_REQUEST['dateOfBirth']);
            $login->setEdad($_REQUEST['edad']);
            $login->setSexo($_REQUEST['sexo']);
            $login->setImagen($_FILES['imgPerfil']['name']);
            $login->setRutaActual($_FILES['imgPerfil']['tmp_name']);
            $login->setIdUsuario($_REQUEST['idUser']);
            echo $login->ConfigPersonalAccount();
        break;
    case 'accountConfigLog':
            $login->setEmail($_REQUEST['email']);
            $login->setUsuario($_REQUEST['user']);
            $login->setPassword($_REQUEST['pass']);
            $login->setIdUsuario($_REQUEST['idUser']);
            echo $login->configLogAccount();
        break;
    
    case 'comprobarEmail':
            $login->setEmail($_REQUEST['email']);
            echo $login->comprobarEmail();
        break;
    case 'comprobarUsuario':
            $login->setUsuario($_REQUEST['user']);
            echo $login->comprobarUsuario();   
        break;
    case 'destroySesion':
            session_start();
            echo $login->cerrarSesion();
        break;
}
