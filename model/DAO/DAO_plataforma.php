<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_plataforma.php');

class DAOPlataforma {
    private $db;
    private $conn;
    private $params;
    private $sql;
     //inicializamos la instancia conexion
     public function __construct(){
        $this->startDB();
    } 

    //metodo que instancia la conexion
    public function startDB(){
        $this->db = new Conexion();
        $this->conn = $this->db->getConnection(); 
    }

    public function closeConnection(){
        $this->db->closeConnection( $this->conn );
     }  


    public function insertData($objetoPlataforma){
        $this->sql="INSERT INTO TblPlataforma
                 (Vch_NombrePlataforma
                 ,Vch_Objetivos_Plataforma
                 ,Vch_Metas_Plataforma
                 ,Vch_Mision_Plataforma
                 ,Vch_Vision_Plataforma
                 ,Vch_Descripcion_Empresa)
             VALUES (?,?,?,?,?,?)"; 
 
 
         $this->params =  array( $objetoPlataforma->getNombre(), $objetoPlataforma->getObjetivos(),
                                 $objetoPlataforma->getMetas(), $objetoPlataforma->getMision(),
                                 $objetoPlataforma->getVision(), $objetoPlataforma->getDescripcion());
 
         $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
 
        $this->closeConnection();
 
         return $insert;
     }
 
     public function updatetData($objetoPlataforma){
         $this->sql="UPDATE TblPlataforma
                     SET Vch_NombrePlataforma = ?
                     ,Vch_Objetivos_Plataforma = ? 
                     ,Vch_Metas_Plataforma = ? 
                     ,Vch_Mision_Plataforma  = ?
                     ,Vch_Vision_Plataforma = ?
                     ,Vch_Descripcion_Empresa = ? 
                     WHERE Int_Id_Plataforma = ? "; 
 
         $this->params =  array( $objetoPlataforma->getNombre(), $objetoPlataforma->getObjetivos(),
                                 $objetoPlataforma->getMetas(), $objetoPlataforma->getMision(),
                                 $objetoPlataforma->getVision(), $objetoPlataforma->getDescripcion(),  $objetoPlataforma->getId());
 
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
     
     public function deleteData($objetoPlataforma){
         $this->sql="DELETE FROM TblPlataforma
         WHERE Int_Id_Plataforma = ? "; 
         $this->params =  array( $objetoPlataforma->getId() );
         $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
         return $delete;
     }
     
 
     public function getData(){
       
        $this->sql="SELECT Int_Id_Plataforma
                     ,Vch_NombrePlataforma
                     ,Vch_Objetivos_Plataforma
                     ,Vch_Metas_Plataforma
                     ,Vch_Mision_Plataforma
                     ,Vch_Vision_Plataforma
                     ,Vch_Descripcion_Empresa
          FROM TblPlataforma";  
         $select = sqlsrv_query( $this->conn, $this->sql);
         $plataforma = array();
          
         while( $row=sqlsrv_fetch_array($select) ){
             $plataforma[] = array(
                'id' =>  $row['Int_Id_Plataforma'],
                'nombrePlataforma'  =>  $row['Vch_NombrePlataforma'],
                'objetivosPlataforma' =>  $row['Vch_Objetivos_Plataforma'],
                'metasPlataforma' =>$row['Vch_Metas_Plataforma'],
                'misionPlataforma' => $row['Vch_Mision_Plataforma'],
                'visionPlataforma' =>  $row['Vch_Vision_Plataforma'],
                'descripcionEmpresa' => $row['Vch_Descripcion_Empresa']
             );
         }
          $encabezado=array("plataforma"=>$plataforma);
          $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);
 
         $this->closeConnection();
         
          return $json_string;
     }

     public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblPlataforma";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}