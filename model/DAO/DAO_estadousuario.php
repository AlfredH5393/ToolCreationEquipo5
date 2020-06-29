<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_estadousuario.php');
class  DAOEstadoUsuario {
    protected $db;
    protected $conn;
    protected $params;
    private $sql;


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

    public function insertData($estadoUser){
        $this->sql="INSERT INTO TblEstadoUsuario(Vch_Nombre_Estado_U,Vch_Descripcion) VALUES(?,?)"; 
        $this->params =  array( $estadoUser->getNombreEstado(), $estadoUser->getDescripcion() );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData($estadoUser){
        $this->sql="UPDATE TblEstadoUsuario
                    SET Vch_Nombre_Estado_U = ?,
                       Vch_Descripcion = ?
                    WHERE Int_Estado_U = ?"; 
        $this->params =  array( $estadoUser->getNombreEstado(), $estadoUser->getDescripcion() , $estadoUser->getId());
        $update = sqlsrv_query( $this->conn, $this->sql, $this->params);

        if($update){
            $encabezado=array("msj"=>"success");
           
        }else{
            $encabezado=array("msj"=>$update);
        }
        $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);
       $this->closeConnection();
        return $json_string;
    }
    
    public function deleteData($estadoUser){
        $this->sql="DELETE FROM TblEstadoUsuario
                    WHERE Int_Estado_U = ? "; 

        $this->params =  array($estadoUser->getId());
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT Int_Estado_U
                        ,Vch_Nombre_Estado_U
                        ,Vch_Descripcion
                    FROM TblEstadoUsuario";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_Estado_U'],
               'nombreEstado'  =>  $row['Vch_Nombre_Estado_U'],
               'descripcion'  =>  $row['Vch_Descripcion']

            );
        }
         $encabezado=array("stateUser"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblEstadoUsuario";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}