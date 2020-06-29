<?php
require('conexion.php');
class MVCEstadoCurso{
    protected $conn;
    protected $params;
    private $sql;
    private $id;
    private $nombreEstadoCurso;
 
    public function setNombreEstadoCurso( $nombreEstadoCurso){
        $this->nombreEstadoCurso = $nombreEstadoCurso;

    }

    public function getNombreEstadoCurso( ){
       return $this->nombreEstadoCurso;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
    
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

    public function insertData(){
        $this->sql="INSERT INTO TblEstado_Curso(Vch_NombreEstado_c) VALUES(?)"; 
        $this->params =  array( $this->nombreEstadoCurso );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblEstado_Curso
                    SET Vch_NombreEstado_c = ?
                    WHERE Int_IdEstado_C = ?"; 
        $this->params =  array( $this->nombreEstadoCurso, $this->id);
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
    
    public function deleteData(){
        $this->sql="DELETE FROM TblEstado_Curso
                    WHERE Int_IdEstado_C = ? "; 

        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_IdEstado_C,
                           Vch_NombreEstado_c
                    FROM TblEstado_Curso";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdEstado_C'],
               'nombreEstadoCurso'  =>  $row['Vch_NombreEstado_c']
            );
        }
         $encabezado=array("estadoCurso"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblEstado_Curso";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}