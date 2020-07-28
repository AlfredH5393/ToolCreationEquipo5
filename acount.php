<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToolCreation</title>
    <link rel="shortcut icon" href="src/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="src/css/normalize.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/icons/all.css">
    <!-- <link rel="stylesheet" href="src/css/bootstrap.css"> -->
   
</head>
<body>
<div class="content-principal" >
    <header class="header-principal">
        <div class="content-logo-principal">      
            <img src="src/img/Logo-ToolCreatiion2.png" width="110" height="70" alt="">
        </div>
        <div class="barra-busqueda-principal">
            <input type="text" placeholder="Buscar">
            <button class="btn-search"><i class="fas fa-search"></i></button>
        </div>

        <?php require('sections/content-menu.php');?>
        <?php require('sections/dropdown.php'); ?>
    
              <button id="btn-menu-principal" class="btn-menu-principal"><i class="fas fa-bars"></i></button> 
              <div><input type="text" id="idUsuario" style="display: none" value="<?php echo  $_SESSION['status']  ?>" ></div>
        </header>
            <div style="display: none">
               <input type="text" name="" id="fechaNacimiento" value="<?php  echo  $_SESSION['FNacimiento'];?>" >  
               <input type="text" name="" id="sexoUser" value="<?php  echo  $_SESSION['sexo'];?>" >   
               <input type="text" name="" id="imagenUsuario" value="<?php  echo  $_SESSION['imagen'];?>" placehoder= "Imagen" >  
               <input type="text" name="" id="telefonoUser" value="<?php  echo  $_SESSION['telefono'];?>" placehoder= "Imagen" >   
               <input type="text" name="" id="idUser" value="<?php  echo  $_SESSION['ID_usuario'];?>" placehoder= "Imagen" > 
               <input type="text" name="" id="idUser" value="<?php  echo  $_SESSION['idProfesor'];?>" placehoder= "Imagen" >  


            </div>
        <?php
            require('sections/account_user.php');
        ?>

        <footer>
            <div class="footer-container">
                <div class="footer-section">
                    <img src="src/img/Logo-ToolCreatiion.png" width="150" height="90" alt="">
                </div>
                <div class="footer-section">
                   <h3>Contenido</h3>
                   <ul>
                      <li><a href="#">Cursos</a></li>
                      <li><a href="#">Especialidades</a></li>
                      <li></li>

                      <!-- <li><a class="btn-iamProfesor" href="#"> Quiero ser intructor</a></li> -->
                   </ul>
                </div>
                <div class="footer-section">
                   <h3>Cursos</h3>
                   <ul>
                      <li><a href="#">WEB</a></li>
                      <li><a href="#">Móvil</a></li>
                      <li><a href="#">Frontend</a></li>
                      <li><a href="#">BackEnd</a></li>
                   </ul>
                </div>
                <div class="footer-section">
                   <h3>Cuenta</h3>
                   <ul>
                      <li><a href="./public/login.html">Iniciar Sesion</a></li>
                      <li><a href="./public/register.html">Crear Cuenta</a></li>
                      <li><a href="./politicas.php">Politicas</a></li>
                      <li><a href="./terminos.php">Termino de uso</a></li>
                   </ul>
                </div>
                <div class="footer-section">
                   <h3>Redes sociales</h3>
                   <ul class="social-footer">
                      <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-github"></i></a></li>
                      <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                   </ul>
                </div>
             </div>
        </footer>

        <div class="my-modal-plataform" id="modal1" v-bind:style="showModal"> <!-- This is the background overlay -->
         <div class="my-modal-content-plataform"> <!-- This is the actual modal/popup box -->
            <!-- <span class="modal-close">&times;</span> -->
            <h1>Bienvenido a ToolCreation como profesor! ✏️</h1>
            <p>Nos da mucho gusto, que se haya unido a nuestra cumunidad de enseñanza para ser el medio entre el conocimiento y el estudiante. 🧑‍🎓</p>
           <img src="src/img/profesor.svg" alt="" style="width: 38% ">
         </div>
      </div>

    </div>
     <!--============================================= SRC JS ==================================================-->
     <script src="src/js/axios.min.js"></script>
     <script src="src/js/vue.js"></script>
     <script src="src/js/cliente_plataform.js"></script>
     <script src="src/js/menu_principal.js"></script>
     <script src="src/js/dropdown.js"></script>
     <script src="src/js/profile.js"></script>
     <!-- <script src="src/js/jquery-3.5.1.min.js"></script> -->
     </body>
</html>