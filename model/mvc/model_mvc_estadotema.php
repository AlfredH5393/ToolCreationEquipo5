
<?php
require ('conexion.php');
class  MVCEstadoTema {
    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $id;
    private $nombreEstadoTema;
 
    public function setNombreEstado( $nombreEstadoTema){
        $this->nombreEstadoTema = $nombreEstadoTema;

    }

    public function getNombreEstado( ){
       return $this->nombreEstadoTema;

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
        $this->sql="INSERT INTO TblEstado_Tema(Vch_NombreEstado_T) VALUES(?)"; 
        $this->params =  array( $this->nombreEstadoTema );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblEstado_Tema
                    SET Vch_NombreEstado_T = ?
                    WHERE Int_IdEstado_T = ?"; 
        $this->params =  array( $this->nombreEstadoTema , $this->id);
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
        $this->sql="DELETE FROM TblEstado_Tema
                    WHERE Int_IdEstado_T = ? "; 

        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT Int_IdEstado_T
                        ,Vch_NombreEstado_T
                    FROM TblEstado_Tema";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdEstado_T'],
               'nombreEstadoTema'  =>  $row['Vch_NombreEstado_T']
            );
        }
         $encabezado=array("stateTema"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblEstado_Tema";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
        $this->closeConnection();
        return $total[0];
    }
}