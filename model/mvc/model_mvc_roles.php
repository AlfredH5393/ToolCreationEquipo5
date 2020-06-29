<?php
require ('conexion.php');
class  MVCRoles  {
    protected $db;
    protected $conn;
    protected $params;
    private $id;
    private $nombreRol;
    
    private $sql;
 
    public function setNombreRol( $nombreRol){
        $this->nombreRol = $nombreRol;

    }

    public function getNombreRol( ){
       return $this->nombreRol;

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
        $this->sql="INSERT INTO TblRoles(vchNombre) VALUES(?)"; 
        $this->params =  array( $this->nombreRol );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblRoles
                    SET vchNombre = ?
                    WHERE IdIntRol = ?"; 
        $this->params =  array( $this->nombreRol, $this->id);
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
        $this->sql="DELETE FROM TblRoles
                    WHERE IdIntRol = ? "; 

        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  IdIntRol,
                        vchNombre
                    FROM TblRoles";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $rol = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $rol[] = array(
               'id' =>  $row['IdIntRol'],
               'nombreRol'  =>  $row['vchNombre']
            );
        }
         $encabezado=array("rol"=>$rol);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblRoles";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}