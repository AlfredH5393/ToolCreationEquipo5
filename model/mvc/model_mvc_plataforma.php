<?php 
require ('conexion.php');
class  MVCPlataforma { 
    protected $db;
    protected $conn;
    private $idPlataforma;
    private $nombrePlataforma;
    private $objetivosPlataforma;
    private $metasPlataforma;
    private $misionPlataforma;
    private $visionPlataforma;
    private $descripcionEmpresa;
    protected $params;
    private $sql;

    //metodo set para los valores 
    public function setData($nombrePlataforma, $objetivosPlataforma, $metasPlataforma, $misionPlataforma, $visionPlataforma, $descripcionEmpresa){
        $this->nombrePlataforma =  $nombrePlataforma;
        $this->objetivosPlataforma =  $objetivosPlataforma;
        $this->metasPlataforma =  $metasPlataforma;
        $this->misionPlataforma =  $misionPlataforma;
        $this->visionPlataforma =  $visionPlataforma;
        $this->descripcionEmpresa =  $descripcionEmpresa;
    }

    public function setId($idPlataforma){
        $this->idPlataforma =  $idPlataforma;
    }

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

    
    public function insertData(){
       //sentencia SQL los ? representan el espacio de los valores donde se colocaran las variables
       $this->sql="INSERT INTO TblPlataforma
                (Vch_NombrePlataforma
                ,Vch_Objetivos_Plataforma
                ,Vch_Metas_Plataforma
                ,Vch_Mision_Plataforma
                ,Vch_Vision_Plataforma
                ,Vch_Descripcion_Empresa)
            VALUES (?,?,?,?,?,?)"; 

        // params son los que le colocan lo valores correspodnientes a SQL
        $this->params =  array( $this->nombrePlataforma,  $this->objetivosPlataforma,
                                $this->metasPlataforma, $this->misionPlataforma,
                                $this->visionPlataforma, $this->descripcionEmpresa);

        //en ste  proceso se  mandan los parametros para  ejecutar el proceso a la base  de datos
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);

        //cerramos la conexion
       $this->closeConnection();

        /*retorna un valor  Boloeano 
            true- si se inserto 
            false - si fallo la insercion
        */
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblPlataforma
                    SET Vch_NombrePlataforma = ?
                    ,Vch_Objetivos_Plataforma = ? 
                    ,Vch_Metas_Plataforma = ? 
                    ,Vch_Mision_Plataforma  = ?
                    ,Vch_Vision_Plataforma = ?
                    ,Vch_Descripcion_Empresa = ? 
                    WHERE Int_Id_Plataforma = ? "; 

        $this->params =  array( $this->nombrePlataforma,  $this->objetivosPlataforma,
                                $this->metasPlataforma, $this->misionPlataforma,
                                $this->visionPlataforma, $this->descripcionEmpresa,  $this->idPlataforma);

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
        $this->sql="DELETE FROM TblPlataforma
        WHERE Int_Id_Plataforma = ? "; 
        $this->params =  array( $this->idPlataforma );
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