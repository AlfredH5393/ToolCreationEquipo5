<?php
require('conexion.php');
class MVCTemas{
    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $idTema;
    private $nombre;
    private $descripcion;
    private $idCurso;
    private $estado;


    public function getIdTema(){return $this->idTema;}
	public function setIdTema($idTema){	$this->idTema = $idTema;}
	public function getNombre(){return $this->nombre;}
	public function setNombre($nombre){	$this->nombre = $nombre;}
	public function getDescripcion(){return $this->descripcion;}
	public function setDescripcion($descripcion){$this->descripcion = $descripcion;}
	public function getIdCurso(){return $this->idCurso;}
	public function setIdCurso($idCurso){$this->idCurso = $idCurso;}
	public function getEstado(){	return $this->estado;}
	public function setEstado($estado){$this->estado = $estado;}

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


     public function insert(){
        $this->sql="INSERT INTO TblTemas(Vch_Nombre_Tema_C ,Vch_Descripcion_T ,Int_VchEstado_T ,Int_FkCurso)
                    VALUES(?,?,?,?)"; 
        $this->params =  array( $this->nombre, $this->descripcion, 1 , $this->idCurso );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $insert;
     }

     public function update(){
        $this->sql="UPDATE TblTemas
                    SET Vch_Nombre_Tema_C = ?
                    ,Vch_Descripcion_T = ?
                WHERE Int_Id_Tema_Curso = ?"; 
        $this->params =  array(  $this->nombre, $this->descripcion, $this->idTema );
        $update = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $update;
     }

     public function delete(){
        $this->sql="DELETE FROM TblTemas
                    WHERE Int_Id_Tema_Curso = ?"; 
        $this->params =  array( $this->idTema );
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $delete;
     }

     public function getData(){
        $this->sql = "SELECT Int_Id_Tema_Curso
                        ,Vch_Nombre_Tema_C
                        ,Vch_Descripcion_T
                        ,Int_VchEstado_T
                        ,Int_FkCurso
                    FROM TblTemas WHERE Int_FkCurso = ?";
         $this->params= array( $this->idCurso );
         $search = sqlsrv_query( $this->conn, $this->sql, $this->params);
         $tema = array();
        
       while( $row=sqlsrv_fetch_array($search) ){
           $tema[] = array(
              'id' =>  $row['Int_Id_Tema_Curso'],
              'nombre'  =>  $row['Vch_Nombre_Tema_C'],
              'descripcion' => $row['Vch_Descripcion_T'],
              'estado' => $row['Int_VchEstado_T'],
              'idCurso' => $row['Int_FkCurso']
           );
       }
        $encabezado=array("temas"=>$tema);
        $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

      $this->closeConnection();

       return $json_string;
    }

     public function countRegister(){
            $this->sql = "SELECT count(*) FROM TblTemas WHERE Int_FkCurso = ?;";
            $this->params = array( $this->idCurso);
            $count = sqlsrv_query( $this->conn, $this->sql, $this->params);
            $total = sqlsrv_fetch_array($count);
            $this->closeConnection();
            return $total[0];
        
     }

}