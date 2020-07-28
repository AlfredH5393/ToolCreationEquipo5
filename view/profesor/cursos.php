<?php
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES' && $_SESSION['profesor'] == "YES") 
{?>
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
            <input type="text" style="display:none" id="idProfesor" value=" <?php echo $_SESSION['idProfesor']  ?>">
        <h2 class="title">Modulo de {{titleModule}}</h2>
        <button class="btn btn-add " type="submit" data-toggle="modal" data-target="#insertModal" ><i class="fas fa-plus"></i> Crear Curso</button>
        <div class="container-alert" v-bind:style="displayAlert">
                <div v-bind:class="alertgeneral" role="alert" style=" width: 60%;" >
                        <p>{{messagealert}}</p>
                        <i v-bind:class="alerticon"></i>
                </div>
            </div>

                <div class="cards-content-curso">
            
                    <div  v-for="curso in listCursos" class="card-curso">
                                <div class="card-curso-header">
                                    <img v-bind:src="'../../src/img/bannerscursos/'+curso.imgCurso" alt="">
                                </div>
                                <div class="card-curso-body">
                                    <div class="date-published"> {{getDateHuman(curso.dateModificacion.date)}} <span><i class="fas fa-calendar"></i></span></div>
                                    <h3>{{curso.nombre}}</h3>
                                    <p>{{curso.descripcion}}</p>
                                    <div class="instructor">
                                        
                                        <button  v-if="curso.estadoCurso == 16 || curso.estadoCurso == 17" style="border:none " class="show-curso mb-2" href="#" @click="irdetallecurso(curso.id)"> <i class="fas fa-wrench"></i> Administrar</button>
                                        <button  type="button" style="border-radius: 20px" class="btn btn-success mb-2 "  data-toggle="modal" data-target="#updateModal" @click= "setDatos(curso)" ><i class="far fa-edit"></i> Editar</button>
                                        <button  v-if="curso.estadoCurso == 16" type="button" style="border-radius: 20px" class="btn btn-delete mb-2"  data-toggle="modal" data-target="#deleteModal" @click= "setDatosEliminar(curso)" ><i class="fas fa-trash-alt"></i> Eliminar</button>
                                        <button  v-else-if="curso.estadoCurso == 2" type="button" style="border-radius: 20px" class="btn btn_confirm mb-2"  data-toggle="modal" data-target="#habilitarModal" @click= "setDatosRestaurar(curso)" ><i class="fas fa-share"></i> Habilitar</button>
                                        <button  v-if="curso.estadoCurso == 16" type="button" style="border-radius: 20px" class="btn btn-primary mb-2"  data-toggle="modal" data-target="#publishModal" @click= "setDatosPublish(curso)" ><i class="fas fa-check"></i> Publicar</button>


                                    </div>
                                </div>
                    </div>

                
                </div>
          
        </main>

        <!-- Modal insertar -->
        <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"> Agregar un curso</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="" class="">
                    <div class="row">
                        <div class="form-group col">
                            <div class="my-form-row">
                            <img alt="" v-bind:src="imgAccount" width="250" class="mb-3">
                           
                            </div>
                           
                            <label for="">Seleccione imagen para su curso</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" @change="previewImage">
                                <label class="custom-file-label" for="customFile">Nombre del archivo</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                          <label for="">Nombre:</label>
                          <input class="form-control" type="text" name="" id="insert-nombre">
                      </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Que aprendera el alumno:</label>
                            <textarea class="form-control" name="" id="insert-conocimiento" cols="20" rows="5"></textarea>
                        </div>
                        <div class="form-group col">
                            <label for="">Requisitos</label>
                            <textarea class="form-control" name="" id="insert-requisitos" cols="30" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Descripcion</label>
                            <textarea class="form-control" name="" id="insert-descripcion" cols="30" rows="5"></textarea>
                        </div>
                        
                    </div>
                    <div class="row">
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
                    </div>
                    
                    
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
                <h3 class="modal-title" id="exampleModalLabel"> Actualizar  curso</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form action="" class="">
                    <div class="row">
                        <div class="form-group col">
                        <input type="text" class="form-control" id="update-idcurso"
                                                    style="display: none;">
                            <div class="my-form-row">
                            <img alt="" v-bind:src="imgAccountUpdate" width="250" class="mb-3">
                           
                            </div>
                           
                            <label for="">Seleccione imagen para su curso</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile-update" @change="previewImageUpdate">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                          <label for="">Nombre:</label>
                          <input class="form-control" type="text" name="" id="update-nombre">
                      </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Que aprendera el alumno:</label>
                            <textarea class="form-control" name="" id="update-conocimiento" cols="20" rows="5"></textarea>
                        </div>
                        <div class="form-group col">
                            <label for="">Requisitos</label>
                            <textarea class="form-control" name="" id="update-requisitos" cols="30" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="">Descripcion</label>
                            <textarea class="form-control" name="" id="update-descripcion" cols="30" rows="5"></textarea>
                        </div>
                        
                    </div>
                    <div class="row">
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
                    </div>
                    
                    
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
                  <h3 class="modal-title" id="exampleModalLabel"> Eliminar curso</h3>
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
                          <br>
                          <p>
                                Por politicas de la empresa, no se puede hacer un borrado fisico del  curso, pero si podemos inhabilitarlos
                                para que en un futuro si usted desea volver a activarlo y asi someterlo a revision con los verficadores de contenido pueda hacerlo,
                                sin ningun tipo de problema 😀.
                          </p>
                      </div>
                      
                    </div> 
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn_confirm"  data-dismiss="modal" @click="eliminar()">Inhabililtar</button>
                </div>
              </div>
            </div>
          </div>    

           <!-- Modal Publish -->
         <div class="modal fade" id="publishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel"> Publicar curso</h3>
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
                          <input class="form-control d-none " type="text" name="" id="publish-id" >
                          <label for="">Nombre:</label>
                          <input class="form-control" type="text" name="" id="publish-nombre" readonly>
                          <br>
                          <p>
                                Este curso sera mandado a revision por un verificardor. y se te notificara por correo en caso de no ser aceptado,
                                el motivo por el cual su curso no pudo ser publicado.
                          </p>
                      </div>
                      
                    </div> 
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn_confirm"  data-dismiss="modal" @click="publicar()">Publicar</button>
                </div>
              </div>
            </div>
          </div>    

          <div class="modal fade" id="habilitarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel"> Restaurar curso</h3>
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
                          <input class="form-control d-none " type="text" name="" id="restaurar-id" >
                          <label for="">Nombre:</label>
                          <input class="form-control" type="text" name="" id="restaurar-nombre" readonly>
                          <br>
                          <p>
                                Gracias por resturar el curso, no llena de felicidad que hayas vuelto a retomarlo !!😀.
                          </p>
                      </div>
                      
                    </div> 
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn_cancel" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn_confirm"  data-dismiss="modal" @click="restaurar()">Habililtar</button>
                </div>
              </div>
            </div>
          </div>    
      
</div>
     <!--============================================= SRC JS ==================================================-->
    
     <script src="../../src/js/axios.min.js"></script>
     <script src="../../src/js/vue.js"></script>
     <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
     <script src="../../src/js/crud_cursos.js"></script>
     <script src="../../src/js/menu.js"></script>
     <script src="../../src/js/jquery-3.5.1.min.js"></script>
     <script src="../../src/plugins/bootstrap.js"></script>     
    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
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