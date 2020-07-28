<?php
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES' &&  $_SESSION['idRol'] == "1") 
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de recursos</title>
    <!--=========================================  Links CSS ======================================================-->
    <link rel="shortcut icon" href="../src/img/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="../src/css/normalize.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/icons/all.css">
    <link rel="stylesheet" href="../src/css/bootstrap.css">
   

</head>
<body>
<div class="contenedor active" id="contenedor">
        <?php require './includes/header.php'?>

         <?php $page = 'tipoRecurso'; require './includes/sidebar.php'?>

        <main class="main">
            <h2 class="title">Modulo de {{titleModule}}</h2>
            <div class="container-alert">
                  <div v-bind:class="alertgeneral" role="alert">
                          <p>{{messagealert}}</p>
                          <i v-bind:class="alerticon"></i>
                  </div>

            </div>
            <div class="wrap-table100" id="wrap-table">
                <div class="card">
                <input class="input-search" type="text" name="" placeholder="Buscar Tipo de recurso" id="searchRegister">

                    <div class="card-header">
                      
                      <h3 class="table-h3">Tabla de Tipo de Recursos</h3>

                      <button class="btn btn-add " type="submit" data-toggle="modal" data-target="#insertModal" ><i class="fas fa-plus"></i></button>
     
                    </div>
                    <div class="card-body ">     
                      <div class="js-pscroll">
                        
                     
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Nombre de tipo de recurso</th>
                         
                            <th></th>  
                          </tr>
                         
                        </thead>
                            <tbody>
                               <tr  v-for="(tiporecursos, index) in typeRecursos" v-show="index >=  anterior && index < siguiente">
                                  <td>{{tiporecursos.id}}</td>
                                  <td>{{tiporecursos.nombreTipoRec}}</td>
                                  <td>
                                    <button  type="button"  class="btn btn-success "  data-toggle="modal" data-target="#updateModal" @click= "setDatos(tiporecursos)" ><i class="far fa-edit"></i></button>
                                    <button type="button"  class="btn btn-delete " data-toggle="modal" data-target="#deleteModal" @click= "setDatosDelete(tiporecursos)"><i class="fas fa-trash-alt"></i></button>
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

        <!-- Modal insertrar -->
          <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"> Agregar un tipo de recurso</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="" class="">
                    <div class="row">
                      <div class="form-group col">
                          <label for="">Nombre:</label>
                          <input class="form-control" type="text" name="" id="insert-nombreTipoRec">
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn_confirm" data-dismiss="modal"  @click="insertar()">Guardar</button>
                </div>
              </div>
            </div>
          </div>

           <!-- Modal update -->
           <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"> Actualizar tipo de recurso</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="" class="">
                    <div class="row">
                      <div class="form-group col">
                          <input class="form-control d-none " type="text" name="" id="update-id">
                          <label for="">Nombre del tipo:</label>
                          <input class="form-control" type="text" name="" id="update-nombreTipoRec">
                      </div>
                    </div>

                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn_confirm" data-dismiss="modal" @click="update()">Guardar</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal delete -->
          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel"> Eliminar Tipo de recurso</h3>
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
                          <input class="form-control d-none " type="text" name="" id="delete-id"  disabled>
                          <label for="">Nombre:</label>
                          <input class="form-control" type="text" name="" id="delete-nombreTipoRec" disabled>
                          
                      </div>
                      
                    </div> 
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn_confirm" data-dismiss="modal" @click="eliminar()">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
 
      
</div>
     <!--============================================= SRC JS ==================================================-->
     
     <script src="../src/js/axios.min.js"></script>
     <script src="../src/js/vue.js"></script>
     <script src="../src/js/crud_tipo_recurso.js"></script>
     <script src="../src/js/menu.js"></script>
     <script src="../src/js/jquery-3.5.1.min.js"></script>
     <script src="../src/plugins/bootstrap.js"></script>
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
 
</body>
</html>
<?php
  }
  else
  {
    header("location: ../public/login.html");
  }
 ?>