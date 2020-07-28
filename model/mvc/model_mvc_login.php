<?php
require('conexion.php');
class MVCLogin {
    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $nombre;
    private $APaterno;
    private $AMaterno;
    private $fechaNacimiento;
    private $edad;
    private $sexo;
    private $email;
    private $telefono;
    private $usuario;
    private $password;
    private $estadoUsuario;
    private $plataforma;
    private $rol;
    private $imagen;
    private $logeo;
    private $rutaActual;
    private $idUsuario;
   

    //metodos de acceso a propiedades
    public function setIdUsuario( $id ){ $this->idUsuario = $id;  }
    public function getId(){ return $this->idUsuario; }
    public function setNombre($value){ $this->nombre = $value; }
    public function getNombre(){ return $this->nombre; }
    public function setApaterno($value){ $this->APaterno = $value; }
    public function getApaterno(){ return $this->APaterno;  }
    public function setAmaterno($value){ $this->AMaterno = $value; }
    public function getAmaterno(){ return $this->AMaterno;  }
    public function setFechaNacimiento($value) { $this->fechaNacimiento = $value; }
    public function getFechaNacimiento() { return $this->fechaNacimiento; }
    public function setEdad($value) { $this->edad = $value; }
    public function getEdad() { return $this->edad; }
    public function setSexo($value) { $this->sexo = $value; }
    public function getSexo() { return $this->sexo; }
    public function setEmail($value) { $this->email = $value; }
    public function getEmail() { return $this->email; }
    public function setTelefono($value) { $this->telefono = $value; }
    public function getTelefono() { return $this->telefono; }
    public function setUsuario($value) { $this->usuario = $value; }
    public function getUsuario() { return $this->usuario; }
    public function setPassword($value) { $this->password = $value; }
    public function getPassword() { return $this->password; }
    public function setEstadoUsuario($value) { $this->estadoUsuario = $value; }
    public function getEstadoUsuario() { return $this->estadoUsuario; }
    public function setPlataforma($value) { $this->plataforma = $value; }
    public function getPlataforma() { return $this->plataforma; }
    public function setRol($value) { $this->rol = $value; }
    public function getRol() { return $this->rol; }
    public function setImagen($value) { $this->imagen = $value; }
    public function getImagen() { return $this->imagen; }
    public function setRutaActual($value) { $this->rutaActual = $value; }
    public function getRutaActual() { return $this->rutaActual; }


    // public function setLogeo($value) { $this->logeo = $value; }
    // public function getLogeo() { return $this->logeo; }
    

    public function __construct(){
        $this->startDB();
    }

    public function startDB(){
        $this->db = new Conexion();
        $this->conn = $this->db->getConnection(); 
    }

    public function closeConnection(){
        $this->db->closeConnection( $this->conn );
    } 

    public function obtenerPasswordAndRol(){
        $this->sql = "SELECT Vch_Contrasena_U,IntIdRol  
        FROM TblUsuario WHERE Vch_Email_U = ? ";
        $this->params = array($this->email);
        $resultSearchPass = sqlsrv_query($this->conn, $this->sql, $this->params);
        $passwordSearched = sqlsrv_fetch_array($resultSearchPass);
        return $passwordSearched;
    }

     public function autenticacion(){
        //Busqueda de contraseña
        // $this->setLogeo(1);
        $passwordSearched = $this->obtenerPasswordAndRol();
        $pass = $passwordSearched[0];
        $rol = $passwordSearched[1];
 
        //Verificacion de contraseña
        if(password_verify($this->password, $passwordSearched[0])){
                //Recoleccion de datos del usuario
                $myparams['Rol'] = $rol;
                $myparams['Email'] = $this->email;
                $myparams['Pass'] = $pass;

                $this->params = array(
                    array(&$myparams['Rol'], SQLSRV_PARAM_IN),
                    array(&$myparams['Email'], SQLSRV_PARAM_IN),
                    array(&$myparams['Pass'], SQLSRV_PARAM_IN)
                );      

                $this->sql = "exec spConsultasLogin @Rol=?,@Email=?,@Pass=?";
                $resultado = sqlsrv_query( $this->conn, $this->sql, $this->params);

                if($resultado === false ){
                    $r[0] = 0;
                    return $r;
                }else{
                    $r = sqlsrv_fetch_array($resultado);
                    return $r;
                }
                // if($resultado === false ){
                //     die( print_r( sqlsrv_errors(), true));
                // }   

        }else{
            $r[0] = false;
            return $r;
        }
        
     }
     
    public function register(){

        $hash = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 10]);

        $this->sql = "INSERT INTO TblUsuario (Vch_Nombre_U, Vch_Ap_Paterno_U, Vch_Ap_Materno_U, Dt_Fecha_Nacimiento_U,
        Int_Edad, Vch_Sexo_U, Vch_Email_U, Vch_Telefono_U, Vch_Usuario_U, Vch_Contrasena_U, Int_Estado_U, Int_Fk_Plataforma, IntIdRol) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->params = array($this->nombre, $this->APaterno, $this->AMaterno, $this->fechaNacimiento, $this->edad, $this->sexo,
                               $this->email, $this->telefono, $this->usuario, $hash, $this->estadoUsuario, $this->plataforma, $this->rol);
        $register = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $register;
    }

    public function cerrarSesion(){
        session_unset();
        return session_destroy();
    }

    public function ConfigPersonalAccount(){
        session_start();
        if($this->imagen != null){
                $this->sql = "UPDATE TblUsuario SET Vch_Nombre_U = ?, Vch_Ap_Paterno_U = ?, Vch_Ap_Materno_U = ?, Dt_Fecha_Nacimiento_U = ?,
                                                    Int_Edad = ? , Vch_Sexo_U= ?, Vch_Telefono_U = ? , vchImagen = ? WHERE Int_Id_Usuario = ? ";
                $this->params = array($this->nombre, $this->APaterno, $this->AMaterno, $this->fechaNacimiento,
                                    $this->edad,$this->sexo, $this->telefono, $this->imagen, $this->idUsuario );
                $update = sqlsrv_query( $this->conn, $this->sql, $this->params);
                $ruta = "../src/img/perfilUsers/".$this->imagen;
                    if($update){
                        move_uploaded_file($this->rutaActual,$ruta);
                        $_SESSION['nombre']        = $this->nombre;
                        $_SESSION['APaterno']      = $this->APaterno;
                        $_SESSION['AMaterno']      = $this->AMaterno;
                        $_SESSION['FNacimiento']   = $this->fechaNacimiento;
                        $_SESSION['edad']          = $this->edad;
                        $_SESSION['sexo']          = $this->sexo;
                        $_SESSION['imagen']        = $this->imagen;
                        $_SESSION['telefono']      = $this->telefono;
                    }
                 return $update;
            }else{
                $this->sql = "UPDATE TblUsuario SET Vch_Nombre_U = ?, Vch_Ap_Paterno_U = ?, Vch_Ap_Materno_U = ?, Dt_Fecha_Nacimiento_U = ?,
                                                    Int_Edad = ? , Vch_Sexo_U= ?, Vch_Telefono_U = ?  WHERE Int_Id_Usuario = ? ";
                $this->params = array($this->nombre, $this->APaterno, $this->AMaterno, $this->fechaNacimiento,
                                    $this->edad,$this->sexo, $this->telefono,  $this->idUsuario );
                $update = sqlsrv_query( $this->conn, $this->sql, $this->params);
                if($update){
                    $_SESSION['nombre']        = $this->nombre;
                    $_SESSION['APaterno']      = $this->APaterno;
                    $_SESSION['AMaterno']      = $this->AMaterno;
                    $_SESSION['FNacimiento']   = $this->fechaNacimiento;
                    $_SESSION['edad']          = $this->edad;
                    $_SESSION['sexo']          = $this->sexo;
                    $_SESSION['telefono']      = $this->telefono;
                }
                
                return $update;
       }
      
   }

    public function configLogAccount(){
        session_start();
        if($this->password == null){
            $this->sql = "UPDATE TblUsuario SET Vch_Email_U = ?,  Vch_Usuario_U = ?  WHERE Int_Id_Usuario = ? ";
            $this->params = array($this->email,  $this->usuario, $this->idUsuario );
            $update = sqlsrv_query( $this->conn, $this->sql, $this->params);
            if($update){
                $_SESSION['usuario'] = $this->usuario;
                $_SESSION['email']   = $this->email;
            }
            $this->closeConnection();
            return $update;

        }else{
            $hash = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 10]);
            $this->sql = "UPDATE TblUsuario SET Vch_Email_U = ?, Vch_Contrasena_U = ?, Vch_Usuario_U = ?  WHERE Int_Id_Usuario = ? ";
            $this->params = array($this->email, $hash, $this->usuario, $this->idUsuario );
            $update = sqlsrv_query( $this->conn, $this->sql, $this->params);
           
            if($update){
                $_SESSION['usuario']  = $this->usuario;
                $_SESSION['email']    = $this->email;
                $_SESSION['password'] = $hash;

            }
            $this->closeConnection();
            return $update;
        }
       
    }

    public function comprobarEmail(){
        $this->sql = " SELECT Vch_Email_U FROM TblUsuario WHERE Vch_Email_U =? ";
        $this->params = array($this->email);
        $comprobEmail = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $total = sqlsrv_fetch_array($comprobEmail);
        if($total[0] == null){
            $this->closeConnection();
            return json_encode(array("msj"=>"No existe"));
           
        }else{
            $this->closeConnection();
            return json_encode(array("msj"=>"Existe"));
        }

    }

    public function comprobarUsuario(){
        $this->sql = " SELECT Vch_Usuario_U FROM TblUsuario WHERE Vch_Usuario_U = ? ";
        $this->params = array($this->usuario);
        $comprobarUser = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $result = sqlsrv_fetch_array($comprobarUser);
        if($result[0] == null){
            $this->closeConnection();
            return json_encode(array("msj"=>"No existe"));
        }else{
            $this->closeConnection();
            return json_encode(array("msj"=>"Existe"));
        }
    }

    public function restorePass(){
        $hash = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 10]);
        $this->sql = "UPDATE TblUsuario SET  Vch_Contrasena_U = ?  WHERE Vch_Email_U = ? ";
        $this->params = array( $hash, $this->email );
        $updatePass = sqlsrv_query( $this->conn, $this->sql, $this->params);
        return $updatePass;
    }
   
}
 