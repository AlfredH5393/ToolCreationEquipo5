<?php
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES' && $_SESSION['profesor'] == "YES") 
{?>


<?php
   $idCurso = $_GET['idcurso']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <!--=========================================  Links CSS ======================================================-->
    <link rel="shortcut icon" href="../../src/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../src/css/normalize.css">
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/icons/all.css">
    <link rel="stylesheet" href="../../src/css/bootstrap.css">
   

</head>
<body>
<div class="contenedor active" id="contenedor">
        <?php   require '../includes/header.php'?>

         <?php $page = 'cursos'; require '../includes/sidebar.php'?>

        <main class="main">
            <input type="text" style="display:none" id="idCurso" value=" <?php echo $idCurso  ?>">
        <h2 class="title">Modulo de {{titleModule}}</h2>
        <div class="container-alert" v-bind:style="displayAlert">
                <div v-bind:class="alertgeneral" role="alert" style=" width: 60%;" >
                        <p>{{messagealert}}</p>
                        <i v-bind:class="alerticon"></i>
                </div>
            </div>
            <div class="wrap-table100" id="wrap-table">
                <div class="card">
                <input class="input-search" type="text" name="" placeholder="Buscar tema" id="searchRegister">

                    <div class="card-header">
                      
                      <h3 class="table-h3">Tabla de temas</h3>

                      <button class="btn btn-add " type="submit" data-toggle="modal" data-target="#insertModal" ><i class="fas fa-plus"></i> Agregar Tema</button>
     
                    </div>
                    <div class="card-body ">     
                      <div class="js-pscroll">
                        
                     
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Nombre del Tema</th>
                            <th></th>  
                          </tr>
                         
                        </thead>
                            <tbody>
                               <tr  v-for="(tema, index) in listaTemas" v-show="index >=  anterior && index < siguiente">
                                  <td>{{tema.id}}</td>
                                  <td>{{tema.nombre}}</td>
                                  <td>
                                    <button  type="button"  class="btn btn-success "  data-toggle="modal" data-target="#updateModal" @click= "setDatos(tema)" ><i class="far fa-edit"></i> Editar</button>
                                    <button type="button"  class="btn btn-delete " data-toggle="modal" data-target="#deleteModal" @click= "setDatosDelete(tema)"><i class="fas fa-trash-alt"></i>Eliminar</button>
                                  </td>
                            </tr>
                            
                        </tbody>
                      </table>
                    </div>
                    </div>
                    <nav aria-label="..." style="padding: 10px">
                     <ul class="pagination">
                        <li v-bind:class="ocultarMostrarAnterior">
                          <a class="page-link" href="#" tabindex="-1" aria-disabled="true" @click="prev">Anterior</a>
                        </li>
                        <li v-for="pagina in paginas" class="page-item">
                          <a class="page-link" @click ="paginar(pagina)" href="#">{{pagina}}</a>
                        </li>
                        <li v-bind:class="ocultarMostrarSiguiente">
                          <a class="page-link" href="#" @click="next">Siguiente</a>
                        </li>
                      </ul>
                   </nav>
                </div>
            </div>
               
        </main>

        <!-- Modal insertar -->
        <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"> Agregar un tema al curso</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="" class="">
                    <div class="row">
                      <div class="form-group col">
                          <label for="">Nombre del tema:</label>
                          <input class="form-control" type="text" name="" id="insert-nombre">
                      </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Descripcion</label>
                            <textarea class="form-control" name="" id="insert-descripcion" cols="30" rows="5"></textarea>
                        </div>
                        
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col">
                            <label for="">Categoria</label>
                             <select name="" class="form-control" id="combo-categoria">
                                 <option value="0">--- Seleccione Categoria ---</option>
                                 <option v-for="Categoria in comboCategoria" v-bind:value="Categoria.id">{{Categoria.nombreCategoria}}</option>
                             </select>
                            <br>
                             <label for="">Nivel de dificultad</label>
                             <select name="" class="form-control" id="combo-nivel">
                                 <option value="0">--- Seleccione nivel ---</option>
                                 <option v-for="Nivel in comboNivel" v-bind:value="Nivel.id">{{Nivel.nombreNivel}}</option>
                             </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Precio</label>
                             <input type="text" name="" class="form-control" id="insert-precio">
                            <br>
                             <label for="">Denominacion</label>
                             <select name="" class="form-control" id="combo-moneda">
                                 <option value="0">--- Seleccione denominación ---</option>
                                 <option v-for="Moneda in comboMoneda" v-bind:value="Moneda.id">{{Moneda.nombreMoneda}}</option>
                             </select>
                        </div>
                    </div> -->
                    
                    
                  </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn_cancel" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn_confirm" data-dismiss="modal" @click="insertar">Guardar</button>
                </div>
              </div>
            </div>
          </div>


           <!-- Modal update -->
    
           <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"> Actualizar  tema</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="" class="">
                    <input class="form-control  " type="text" name="" id="update-id" >
                    <div class="row">
                      <div class="form-group col">
                          <label for="">Nombre del tema:</label>
                          <input class="form-control" type="text" name="" id="update-nombre">
                      </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Descripcion</label>
                            <textarea class="form-control" name="" id="update-descripcion" cols="30" rows="5"></textarea>
                        </div>
                        
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col">
                            <label for="">Categoria</label>
                             <select name="" class="form-control" id="update-combo-categoria">
                                 <option value="0">--- Seleccione Categoria ---</option>
                                 <option v-for="Categoria in comboCategoria" v-bind:value="Categoria.id">{{Categoria.nombreCategoria}}</option>
                             </select>
                            <br>
                             <label for="">Nivel de dificultad</label>
                             <select name="" class="form-control" id="update-combo-nivel">
                                 <option value="0">--- Seleccione nivel ---</option>
                                 <option v-for="Nivel in comboNivel" v-bind:value="Nivel.id">{{Nivel.nombreNivel}}</option>
                             </select>
                        </div>
                        <div class="form-group col">
                            <label for="">Precio</label>
                             <input type="text" name="" class="form-control" id="update-precio">
                            <br>
                             <label for="">Denominacion</label>
                             <select name="" class="form-control" id="update-combo-moneda">
                                 <option value="0">--- Seleccione denominación ---</option>
                                 <option v-for="Moneda in comboMoneda" v-bind:value="Moneda.id">{{Moneda.nombreMoneda}}</option>
                             </select>
                        </div>
                    </div> -->
                    
                    
                  </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn_cancel" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn_confirm" data-dismiss="modal" @click="update">Actualizar</button>
                </div>
              </div>
            </div>
          </div>

         <!-- Modal delete -->
         <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel"> Eliminar tema</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" class="">
                 
                    <div class="row">
                    <div class="container-alert mt-0">
                                <div class=" mt-0 mb-0 myalert" role="alert">
                                    <i class="fas fa-exclamation bg-infoDanger"></i>
                                </div>
                        </div>
                      <div class="form-group col">
                          <input class="form-control d-none " type="text" name="" id="delete-id" >
                          <label for="">Nombre:</label>
                          <input class="form-control" type="text" name="" id="delete-nombre" readonly>
                      </div>
                      
                    </div> 
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn_confirm"  data-dismiss="modal" @click="eliminar()">Eliminar</button>
                </div>
              </div>
            </div>
          </div>    

       
      
</div>
     <!--============================================= SRC JS ==================================================-->
    
     <script src="../../src/js/axios.min.js"></script>
     <script src="../../src/js/vue.js"></script>
     <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
     <script src="../../src/js/crud_tema.js"></script>
     <script src="../../src/js/menu.js"></script>
     <script src="../../src/js/jquery-3.5.1.min.js"></script>
     <script src="../../src/plugins/bootstrap.js"></script>     
     <script>
       document.getElementById("searchRegister").onkeyup = function() {
            let buscar_= this.value.toLowerCase() ;
            document.querySelectorAll('.table tbody tr').forEach(function(e){
              let encontro_ =false;
              e.querySelectorAll('td').forEach(function(e){
                if (e.innerHTML.toLowerCase().indexOf(buscar_)>=0){
                  encontro_=true;
                }
              }); 
              if (encontro_){
                e.style.display = '';
              }else{
                e.style.display = 'none';
              }
            });              
        }
     </script>
    <script>
    // Add the following code if you want the name of the file appear on select
    // $(".custom-file-input").on("change", function() {
    // var fileName = $(this).val().split("\\").pop();
    // $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    // });
    </script>
    
     
 
</body>
</html>
<?php
  }
  else
  {
    header("location: ../../public/login.html");
  }
 ?>