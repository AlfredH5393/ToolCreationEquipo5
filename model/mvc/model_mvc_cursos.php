<?php
require ('conexion.php');
class MVCCurso {

    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $idCurso;
    private $nombre;
    private $conocimiento;
    private $descripcion;
    private $requistos;
    private $videoPrueba;
    private $rutaVideoActual;
    private $categoria;
    private $nivel;
    private $estadoCurso;
    private $precio;
    private $moneda;
    private $precioPromocion;
    private $instructor;
    private $imagenCurso;
    private $rutaActualImagen;

    public function getId(){return $this->idCurso;}
	public function setId($idCurso){$this->idCurso = $idCurso;	}
    public function getNombre(){return $this->nombre;}
	public function setNombre($nombre){$this->nombre = $nombre;	}
	public function getConocimiento(){return $this->conocimiento;}
	public function setConocimiento($conocimiento){$this->conocimiento = $conocimiento;}
	public function getDescripcion(){	return $this->descripcion;}
	public function setDescripcion($descripcion){$this->descripcion = $descripcion;}
	public function getRequistos(){return $this->requistos;}
	public function setRequistos($requistos){$this->requistos = $requistos;}
	public function getVideoPrueba(){return $this->videoPrueba;}
	public function setVideoPrueba($videoPrueba){$this->videoPrueba = $videoPrueba; }
	public function getRutaVideoActual(){return $this->rutaVideoActual;}
	public function setRutaVideoActual($rutaVideoActual){$this->rutaVideoActual = $rutaVideoActual;}
	public function getCategoria(){return $this->categoria;}
	public function setCategoria($categoria){$this->categoria = $categoria;}
	public function getNivel(){return $this->nivel;}
	public function setNivel($nivel){$this->nivel = $nivel;}
	public function getEstadoCurso(){return $this->estadoCurso;}
	public function setEstadoCurso($estadoCurso){$this->estadoCurso = $estadoCurso;}
	public function getPrecio(){return $this->precio;}
	public function setPrecio($precio){$this->precio = $precio;}
	public function getMoneda(){return $this->moneda;}
	public function setMoneda($moneda){$this->moneda = $moneda;}
	public function getPrecioPromocion(){return $this->precioPromocion;}
	public function setPrecioPromocion($precioPromocion){$this->precioPromocion = $precioPromocion;}
	public function getInstructor(){return $this->instructor;}
	public function setInstructor($instructor){$this->instructor = $instructor;}
	public function getImagenCurso(){return $this->imagenCurso;}
	public function setImagenCurso($imagenCurso){$this->imagenCurso = $imagenCurso;}
	public function getRutaActualImagen(){return $this->rutaActualImagen;}
	public function setRutaActualImagen($rutaActualImagen){$this->rutaActualImagen = $rutaActualImagen;}

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
         $fechaHoy = date('Y-m-d');
        if($this->imagenCurso == null){
            $this->sql = "INSERT INTO TblCurso(Vch_Nobre_Curso, Vch_Conocimiento_Curso, VchDescripcion_Curso, VchRequisitos_Curso,
            Int_FkCategoria_Curso, Int_Fk_Nivel_Curso,Int_Estado_Curso, Fl_Precio_Curso, Int_FkMoneda_Curso, FK_Instructor,DT_Fecha_Creacion, DT_UltimaFecha_modificacion)
                 VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->params= array($this->nombre, $this->conocimiento, $this->descripcion, $this->requistos, $this->categoria,
                                 $this->nivel, 16, $this->precio, $this->moneda, $this->instructor, $fechaHoy, $fechaHoy );
            $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);

        }else{
            $this->sql = "INSERT INTO TblCurso(Vch_Nobre_Curso,Vch_Conocimiento_Curso,VchDescripcion_Curso,VchRequisitos_Curso,
            Int_FkCategoria_Curso,Int_Fk_Nivel_Curso,Int_Estado_Curso,Fl_Precio_Curso,Int_FkMoneda_Curso,FK_Instructor,DT_Fecha_Creacion,vchImagenCurso,DT_UltimaFecha_modificacion)
                 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->params= array($this->nombre, $this->conocimiento, $this->descripcion, $this->requistos, $this->categoria,
                                 $this->nivel, 16, $this->precio, $this->moneda, $this->instructor, $fechaHoy, $this->imagenCurso, $fechaHoy );
            $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
            if($insert){
               $ruta = "../src/img/bannerscursos/".$this->imagenCurso;
                move_uploaded_file($this->rutaActualImagen,$ruta);
            }
          
        }
        return $insert;
     }

     public function updateData(){
        $fechaHoy = date('Y-m-d');
       if($this->imagenCurso == null){
           $this->sql = "UPDATE TblCurso
                        SET Vch_Nobre_Curso =?
                            ,Vch_Conocimiento_Curso = ?
                            ,VchDescripcion_Curso = ?
                            ,VchRequisitos_Curso = ?
                            ,Int_FkCategoria_Curso = ?
                            ,Int_Fk_Nivel_Curso = ?
                            ,Fl_Precio_Curso = ?
                            ,Int_FkMoneda_Curso = ?
                            ,DT_UltimaFecha_modificacion = ?
                        WHERE Int_IdCurso = ?";
           $this->params= array($this->nombre, $this->conocimiento, $this->descripcion, $this->requistos, $this->categoria,
                                $this->nivel, $this->precio, $this->moneda ,$fechaHoy, $this->idCurso);
           $update = sqlsrv_query( $this->conn, $this->sql, $this->params);

       }else{
           $this->sql = "UPDATE TblCurso
                        SET Vch_Nobre_Curso =?
                            ,Vch_Conocimiento_Curso = ?
                            ,VchDescripcion_Curso = ?
                            ,VchRequisitos_Curso = ?
                            ,Int_FkCategoria_Curso = ?
                            ,Int_Fk_Nivel_Curso = ?
                            ,Fl_Precio_Curso = ?
                            ,Int_FkMoneda_Curso = ?
                            ,vchImagenCurso = ?
                            ,DT_UltimaFecha_modificacion = ?
                        WHERE Int_IdCurso = ? ";
           $this->params= array($this->nombre, $this->conocimiento, $this->descripcion, $this->requistos, $this->categoria,
                                $this->nivel, $this->precio, $this->moneda, $this->imagenCurso ,$fechaHoy, $this->idCurso );
           $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
           if($update){
              $ruta = "../src/img/bannerscursos/".$this->imagenCurso;
               move_uploaded_file($this->rutaActualImagen,$ruta);
           }
         
       }
       return $update;
    }

    public function eliminar(){
        $this->sql = "UPDATE TblCurso
        SET Int_Estado_Curso = ?
        WHERE Int_IdCurso = ? ";
        $this->params= array(2, $this->idCurso );
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
        return $delete;
    }

    public function publicar(){
        $this->sql = "UPDATE TblCurso
        SET Int_Estado_Curso = ?
        WHERE Int_IdCurso = ? ";
        $this->params= array(17, $this->idCurso );
        $publicacion = sqlsrv_query( $this->conn, $this->sql, $this->params);
        return $publicacion;
    }

    public function restaurar(){
        $this->sql = "UPDATE TblCurso
        SET Int_Estado_Curso = ?
        WHERE Int_IdCurso = ? ";
        $this->params= array(16, $this->idCurso );
        $restauracion = sqlsrv_query( $this->conn, $this->sql, $this->params);
        return $restauracion;
    }


     public function showData(){
         $this->sql = " SELECT Int_IdCurso,Vch_Nobre_Curso ,Vch_Conocimiento_Curso ,VchDescripcion_Curso ,VchRequisitos_Curso
         ,VchVideoPrueba ,Int_FkCategoria_Curso ,Int_Fk_Nivel_Curso,Int_Estado_Curso ,Fl_Precio_Curso,Int_FkMoneda_Curso
         ,Fk_PrecioPromoCurso,FK_Instructor,DT_Fecha_Creacion ,vchImagenCurso ,DT_UltimaFecha_modificacion
         FROM TblCurso where FK_Instructor = ?";
          $this->params= array( $this->instructor );
          $search = sqlsrv_query( $this->conn, $this->sql, $this->params);
          $curso = array();
         
        while( $row=sqlsrv_fetch_array($search) ){
            $curso[] = array(
               'id' =>  $row['Int_IdCurso'],
               'nombre'  =>  $row['Vch_Nobre_Curso'],
               'conocimiento' => $row['Vch_Conocimiento_Curso'],
               'descripcion' => $row['VchDescripcion_Curso'],
               'requisitos' => $row['VchRequisitos_Curso'],
               'videoPrueba' => $row['VchVideoPrueba'],
               'categoria' => $row['Int_FkCategoria_Curso'],
               'nivel' => $row['Int_Fk_Nivel_Curso'],
               'estadoCurso' => $row['Int_Estado_Curso'],
               'precio' => $row['Fl_Precio_Curso'],
               'moneda' => $row['Int_FkMoneda_Curso'],
               'precioPromo' => $row['Fk_PrecioPromoCurso'],
               'instructor' => $row['FK_Instructor'],
               'fechaCreacion' => $row['DT_Fecha_Creacion'],
               'imgCurso' => $row['vchImagenCurso'],
               'dateModificacion' => $row['DT_UltimaFecha_modificacion']
            );
        }
         $encabezado=array("curso"=>$curso);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
     }

     public function showDataCursoClient(){

        $this->sql = "SELECT TblCurso.Int_IdCurso,TblCurso.FK_Instructor, TblCurso.Vch_Nobre_Curso,COUNT(TblCurso.Vch_Nobre_Curso) - 1 AS 'CantidadDeRegistrados',
		TblCurso.Vch_Conocimiento_Curso ,TblCurso.VchDescripcion_Curso ,TblCurso.VchRequisitos_Curso,TblCategoriaInstructor.Vch_CategoriaInst,TblNivel.Vch_Nombre_Nivel,TblCurso.Fl_Precio_Curso, TblMoneda.VchNombre_Moneda,
		TblCurso.vchImagenCurso, TblCurso. DT_UltimaFecha_modificacion,	CONCAT( TblUsuario.Vch_Nombre_U,' ',TblUsuario.Vch_Ap_Paterno_U ,' ',TblUsuario.Vch_Ap_Materno_U) AS 'nombreInstructor',
		TblUsuario.vchImagen AS 'imgUser' FROM TblCurso 
		inner join TblInstructor ON TblInstructor.Int_IdInstructor = TblCurso.FK_Instructor
		inner join TblUsuario ON TblUsuario.Int_Id_Usuario = TblInstructor.Int_FkUsuario_Inst
		inner join TblCategoriaInstructor ON TblCategoriaInstructor.Int_IdCategoria_Inst = TblCurso.Int_FkCategoria_Curso
		inner join TblNivel ON TblNivel.Int_IdNivel_Curso = TblCurso.Int_Fk_Nivel_Curso
		inner join TblMoneda ON TblMoneda.Int_Id_Moneda = TblCurso.Int_FkMoneda_Curso
	    WHERE TblCurso.Int_Estado_Curso = 17
		GROUP BY TblCurso.Int_IdCurso,TblCurso.FK_Instructor, TblCurso.Vch_Nobre_Curso,TblCurso.Vch_Conocimiento_Curso ,TblCurso.VchDescripcion_Curso ,TblCurso.VchRequisitos_Curso, TblCategoriaInstructor.Vch_CategoriaInst,TblNivel.Vch_Nombre_Nivel, TblCurso.Fl_Precio_Curso, TblMoneda.VchNombre_Moneda, TblCurso.vchImagenCurso,
		TblCurso.DT_UltimaFecha_modificacion,TblUsuario.vchImagen,TblUsuario.Vch_Nombre_U,TblUsuario.Vch_Ap_Paterno_U,TblUsuario.Vch_Ap_Materno_U ;";
        $search = sqlsrv_query( $this->conn, $this->sql);
        $cursoList = array();
        while( $row=sqlsrv_fetch_array($search) ){
            $cursoList[] = array(
               'id' =>  $row['Int_IdCurso'],
               'idInstructor' => $row['FK_Instructor'],
               'nombre'  =>  $row['Vch_Nobre_Curso'],
               'incritos' => $row['CantidadDeRegistrados'],
               'conocimiento' => $row['Vch_Conocimiento_Curso'],
               'descripcion' => $row['VchDescripcion_Curso'],
               'requisitos' => $row['VchRequisitos_Curso'],
               'categoria' => $row['Vch_CategoriaInst'],
               'nivel' => $row['Vch_Nombre_Nivel'],
               'precio' => $row['Fl_Precio_Curso'],
               'moneda' => $row['VchNombre_Moneda'],
               'instructor' => $row['nombreInstructor'],
               'imgCurso' => $row['vchImagenCurso'],
               'dateModificacion' => $row['DT_UltimaFecha_modificacion'],
               'imgUser' => $row['imgUser']
            );
        }
        $encabezado=array("cursoList"=>$cursoList);
        $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);
        $this->closeConnection();
        return $json_string;
     }

     public function cursoDeatail(){
        $this->sql = "SELECT TblCurso.Int_IdCurso,  TblCurso.FK_Instructor,  TblCurso.Vch_Nobre_Curso,  TblCurso.Vch_Conocimiento_Curso ,
        TblCurso.VchDescripcion_Curso , TblCurso.VchRequisitos_Curso, TblCategoriaInstructor.Vch_CategoriaInst,  TblNivel.Vch_Nombre_Nivel,
        TblCurso.Fl_Precio_Curso,TblMoneda.VchNombre_Moneda,TblCurso.vchImagenCurso, TblCurso.DT_UltimaFecha_modificacion,
        CONCAT( TblUsuario.Vch_Nombre_U,' ',TblUsuario.Vch_Ap_Paterno_U ,' ',TblUsuario.Vch_Ap_Materno_U) AS 'nombreInstructor',
        TblUsuario.vchImagen AS 'imgUser'
        FROM TblCurso 
        inner join TblInstructor ON TblInstructor.Int_IdInstructor = TblCurso.FK_Instructor
        inner join TblUsuario ON TblUsuario.Int_Id_Usuario = TblInstructor.Int_FkUsuario_Inst
        inner join TblCategoriaInstructor ON TblCategoriaInstructor.Int_IdCategoria_Inst = TblCurso.Int_FkCategoria_Curso
        inner join TblNivel ON TblNivel.Int_IdNivel_Curso = TblCurso.Int_Fk_Nivel_Curso
        inner join TblMoneda ON TblMoneda.Int_Id_Moneda = TblCurso.Int_FkMoneda_Curso
        WHERE TblCurso.Int_Estado_Curso = 17 AND TblCurso.Int_IdCurso = ?";

        $this->params = array($this->idCurso  ); 
        $search = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $cursoDetalle = array();
        while( $row=sqlsrv_fetch_array($search) ){
            $cursoDetalle[] = array(
               'id' =>  $row['Int_IdCurso'],
               'idInstructor' => $row['FK_Instructor'],
               'nombre'  =>  $row['Vch_Nobre_Curso'],
               'conocimiento' => $row['Vch_Conocimiento_Curso'],
               'descripcion' => $row['VchDescripcion_Curso'],
               'requisitos' => $row['VchRequisitos_Curso'],
               'categoria' => $row['Vch_CategoriaInst'],
               'nivel' => $row['Vch_Nombre_Nivel'],
               'precio' => $row['Fl_Precio_Curso'],
               'moneda' => $row['VchNombre_Moneda'],
               'instructor' => $row['nombreInstructor'],
               'imgCurso' => $row['vchImagenCurso'],
               'dateModificacion' => $row['DT_UltimaFecha_modificacion'],
               'imgUser' => $row['imgUser']
            );
        }
        $encabezado=array("cursoDetail"=>$cursoDetalle);
        $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);
        $this->closeConnection();
        return $json_string;  
     }
 }