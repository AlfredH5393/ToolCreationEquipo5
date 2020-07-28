<?php
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES' && $_SESSION['profesor'] == "YES") 
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola beinvenido a ToolCreation</title>
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

         <?php $page = 'home'; require '../includes/sidebar.php'?>

        <main class="main">
          
          <div class="content-grid">
              <div class="grid-item grid-item1">
                <div class=" my-perfil-dash">
                   <h4><?php echo $_SESSION['nombre'].' '. $_SESSION['APaterno'].' '.$_SESSION['AMaterno']  ?></h4>
                   <img  <?php $nameImg=$_SESSION['imagen'];
                      echo $varSrc='src="../../src/img/perfilUsers/'.$nameImg.'"';
                      ?> alt="">
                   
                    <p class="rol">Profesor</p>
                    <?php 
                      if($_SESSION['status'] == "activo"){
                    ?>
                        <p class="status"> <i class="fas fa-plug"></i> Conectado</p>
                    <?php 
                    }
                    ?>
                </div>
              </div>

              <div class="grid-item grid-item2">
                <div class="wolcome-dash">
                  <div class="text-welcome">
                  <h1>Bienvenid@</h1>
                   <p>En este panel tienes acceso a herramientas para que usted como profesor administre mudulos para crear cursos, y 
                     trasmintir su conocimiento a los estudiantes.
                   </p>
                  </div>
                  <div class="img-welcome">
                    <img src="../../src/img/admin4.svg" alt="">
                  </div>
                   

                </div>
              </div>

              <div class=" grid-item grid-item3">
                <div class="form1-dash">
                  <h4>Modulo Top 1</h4>
                   <span><img src="./../../src/img/file-video.svg" alt=""></span> <a href="#">Crear un curso</a>
                </div>
              </div>
              
              <div class=" grid-item grid-item4">
                <div class="form2-dash">
                <h4>Modulo Top 2</h4>
                   <span><img src="./../../src/img/file.svg" alt=""></span> <a href="#">Estado de su curso</a>
                </div>
              </div>
              <!-- <div class="grid-item5">
                <div class="card">
                   <h1>item 5</h1>
                </div>
              </div> -->

          </div>
        </main>

            
      
</div>
     <!--============================================= SRC JS ==================================================-->
    
     <script src="../../src/js/axios.min.js"></script>
     <script src="../../src/js/vue.js"></script>
     <script src="../../src/js/profesor_plataform.js"></script>
     <script src="../../src/js/menu.js"></script>
     <script src="../../src/js/jquery-3.5.1.min.js"></script>
     <script src="../../src/plugins/bootstrap.js"></script>
    
     
 
</body>
</html>
<?php
  }
  else
  {
    header("location: ../../public/login.html");
  }
 ?>