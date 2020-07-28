<?php
session_start();
?>

<?php
   $idCurso = $_GET['idcurso']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de curso </title>
    <link rel="shortcut icon" href="src/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="src/css/normalize.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/icons/all.css">
</head>
<body>
<div class="content-principal" id="contenedor">
    <header class="header-principal">
        <div class="content-logo-principal">      
            <a href="index.php"><img src="src/img/Logo-ToolCreatiion2.png" width="110" height="70" alt=""></a> 
        </div>
        <div class="barra-busqueda-principal">
            <input type="text" placeholder="Buscar">
            <button class="btn-search"><i class="fas fa-search"></i></button>
        </div>

        <?php require('sections/content-menu.php');?>
        <?php require('sections/dropdown.php'); ?>
    
              <button id="btn-menu-principal" class="btn-menu-principal"><i class="fas fa-bars"></i></button> 
              <div><input type="text" id="idUsuario" style="display: none" value="<?php echo  $_SESSION['status']  ?>" >
                     <input type="text" id="idCurso-detail" style="display: none" value="<?php echo $idCurso ?>" >
                </div>
        </header>

           <?php require 'sections/detail_body.html' ?> 
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
</div>
   


     <script src="src/js/axios.min.js"></script>
     <script src="src/js/vue.js"></script>
     <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
     <script src="src/js/detail_curso.js"></script>
     <script src="src/js/menu_principal.js"></script>
     <script src="src/js/dropdown.js"></script>
     <script>
            let acc = document.getElementsByClassName("accordion");
            let i;

            for (i = 0; i < acc.length; i++) {
            acc[i].onclick = function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight){
                panel.style.maxHeight = null;
                } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
                } 
            }
            }
     </script>
</body>
</html>