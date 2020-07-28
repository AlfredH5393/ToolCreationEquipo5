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
            <a href="index.php"><img src="src/img/Logo-ToolCreatiion2.png" width="110" height="70" alt=""></a> 
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

        <section class="welcome-principal">
            <h1>Politicas de nuetra Plataforma</h1>
             <p>En ToolCreation  al utilizar los Servicios, el usuario acepta los términos de esta Política que nosotros nos comprometemos administrar de manera correcta
                 El usuario no deberá utilizar los Servicios si no está de acuerdo con estas Políticas
                 con cualquier o cualquier otro acuerdo que rija el uso que hace de los Servicios</p>
             <img src="./src/img/politics.svg" alt="">
            
           
        </section>

     
        <div class="plan-studio">
                <button class="accordion">GESTIÓN DE CLAVES</button>
                <div class="panel">
                <ul>
                    <li> 
                      ✔️ Respetar la privacidad de las cuentas de los demás usuarios de la organización dentro como fuera de ella el usuario no podrá utilizar identidades ficticias o de otros usuarios.
                    </li>
                    <li>
                      ✔️ Las claves o contraseñas que se ocupen en la plataforma deberán poseer un grado de complejidad para no ser de fácil desciframiento.
                    </li>
                    <li>
                      ✔️ Los usuarios son los únicos responsables por la seguridad de sus credenciales de acceso (usuario y contraseña), las cuales son de uso exclusivo, único e intransferible.
                    </li>
                    <li>
                      ✔️ ToolCreation  debe definir un procedimiento de gestión de claves, donde incluirán los métodos para la recuperación de claves en caso de pérdida( Envio de Email).
                    </li>
                    <li>
                     ✔️ Todas las contraseñas deberán actualizarse cada cierto tiempo, para que las claves no queden expuestas al usarse, el tiempo se definirá por el administrador de la seguridad de la información e enviara nitificacion a los usuarios de la plataforma.
                    </li>
                </ul>
                </div>
            </div>

            <div class="plan-studio">
                <button class="accordion">PROPIEDAD DEL CONTENIDO (INSTRUCTORES)</button>
                <div class="panel">
                <ul>
                    <li> 
                      ✔️ El docente contara con constancia que avale que cuenta con los derechos de todo su contenido dentro creado y publicado en la plataforma ToolCreation.
                    </li>
                    <li>
                      ✔️ Toda la información del curso se encontrará clasificada para protección de la información sensible, secreto, inactivo, privado, no publicado y para los datos curso que ya esten validados la categoría es publicada.
                    </li>
                </ul>
                </div>
            </div>

            <div class="plan-studio">
                <button class="accordion">PROCESO DICIPLINADO (USUARIO EN GENERAL)</button>
                <div class="panel">
                <ul>
                    <li> 
                      ✔️ Si se llega a violar la seguridad de información se  recolectarian las suficientes pruebas para llevar a cabo acción legal contra el usuario, persona o organizacion que ejercio dicho ataque.
                    </li>
                    <li>
                      ✔️ Asignar una cita consignado  una hora, fecha y lugar y se le asignara a la entidad un tiempo específico para que este pueda recolectar la prueba suficiente para su defensa.
                    </li>
                    <li>
                      ✔️ Se hará cumplir la sanción ya que el usuario tendrá en claro que a acepto terminos de uso en la plataforma  y tendrá que cumplir la sanción por el delito que se le asigne
                    </li>
                </ul>
                </div>
            </div>


        
        
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
    </div>
     <!--============================================= SRC JS ==================================================-->
     <script src="src/js/axios.min.js"></script>
     <script src="src/js/vue.js"></script>
     <script src="src/js/cliente_plataform.js"></script>
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