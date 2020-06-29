<?php
require ('conexion.php');
class  MVCGradoConocimiento  {
    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $id;
    private $nombreGradoConocimiento;
 
    public function setNombreGradoConocimiento( $nombreGradoConocimiento){
        $this->nombreGradoConocimiento = $nombreGradoConocimiento;

    }

    public function getNombreGradoConocimiento( ){
       return $this->nombreGradoConocimiento;

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
        $this->sql="INSERT INTO TblGradoConocimiento(Vch_Nombre_Grado_Inst) VALUES(?)"; 
        $this->params =  array( $this->nombreGradoConocimiento );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblGradoConocimiento
                    SET Vch_Nombre_Grado_Inst = ?
                    WHERE Int_IdGradoInstructor = ?"; 
        $this->params =  array( $this->nombreGradoConocimiento, $this->id);
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
        $this->sql="DELETE FROM TblGradoConocimiento
                    WHERE Int_IdGradoInstructor = ? "; 

        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_IdGradoInstructor,
                           Vch_Nombre_Grado_Inst
                    FROM TblGradoConocimiento";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdGradoInstructor'],
               'nombreGrado'  =>  $row['Vch_Nombre_Grado_Inst']
            );
        }
         $encabezado=array("gradoConocimiento"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblGradoConocimiento";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}