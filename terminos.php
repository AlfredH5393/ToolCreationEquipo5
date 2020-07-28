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
            <h1>Terminos de uso de nuetra Plataforma</h1>
             <p>La misión de ToolCreation es mejorar la vida de las personas mediante el aprendizaje. 
                 Permitimos que cualquier persona pueda crear y compartir cursos educativos (instructores), 
                 e inscribirse en estos cursos educativos para aprender (estudiantes) en cualquier parte del mundo. 
                 Creemos que nuestro modelo de tienda virtual es la mejor manera de ofrecer contenido educativo
                  valioso a nuestros usuarios. Necesitamos reglas que mantengan nuestra plataforma y nuestros servicios
                   seguros para usted, para nosotros, para nuestros estudiantes y para nuestra comunidad de instructores.
                </p>
             <img src="./src/img/terms.svg" alt="">
            
           
        </section>

        <div class="plan-studio">
                <button class="accordion">CUENTAS</button>
                <div class="panel">
                <ul>
                    <li> 
                    Necesita una cuenta para la mayoría de las actividades que se llevan a cabo en nuestra plataforma. Guarde su contraseña de forma segura, porque deberá asumir la responsabilidad de todas las actividades asociadas con su cuenta. Si sospecha que alguien está utilizando su cuenta, avísenos; para ello, póngase en contacto con nuestro Equipo de asistencia. Para poder utilizar ToolCreation, deberá tener la mayoría de edad establecida para el uso de servicios en línea en su país.
                        Necesita una cuenta para la mayoría de actividades que se llevan a cabo en nuestra plataforma, incluidas las de comprar un curso, inscribirse en un curso o enviar un curso para su publicación. Al configurar y mantener su cuenta, debe proporcionar en todo momento información precisa y completa, incluida una dirección de correo electrónico válida. Asume toda la responsabilidad respecto a la cuenta y todo lo que sucede en ella, incluidos los daños o lesiones (que suframos nosotros o cualquier otra persona) causados por alguien que utilice su cuenta sin su permiso. Esto significa que debe tener cuidado con su contraseña. No puede transferir su cuenta a otra persona, ni utilizar la cuenta de otra persona. Si se pone en contacto con nosotros para solicitar el acceso a una cuenta, no se lo concederemos a menos que pueda proporcionarnos la información necesaria para demostrar que es el propietario de dicha cuenta. Si un usuario fallece, su cuenta se cerrará.

                    </li>
                </ul>
                </div>
            </div>

            <div class="plan-studio">
                <button class="accordion">INSCRIPCIÓN EN UN CURSO Y ACCESO DE POR VIDA</button>
                <div class="panel">
                <ul>
                    <li> 
                    Cuando se inscribe en un curso, le proporcionamos una licencia para verlo a través de los Servicios de ToolCreation, pero para ningún otro uso. No intente transferir ni revender los cursos de ninguna forma. Le concedemos una licencia de acceso de por vida, excepto cuando debamos desactivar el curso por motivos legales o relacionados con determinadas políticas.
                    De conformidad con nuestras Condiciones del instructor, cuando los instructores publican un curso en ToolCreation, proporcionan a ToolCreation la licencia para ofrecer a los estudiantes la correspondiente licencia para el curso. Esto significa que tenemos derecho a sublicenciar el curso a los estudiantes que se inscriban en él. Como estudiante, cuando se inscribe en un curso, ya sea gratis o de pago, ToolCreation le proporcionará una licencia de ToolCreation para ver el curso a través de la plataforma de ToolCreation y los Servicios, y ToolCreation es el licenciatario registrado. Obtiene una licencia para disfrutar de los cursos, pero no se le venden. Esta licencia no le otorga ningún derecho a revender el curso de ninguna manera; tampoco puede compartir la información de la cuenta con un comprador ni descargar el curso ilegalmente para después compartirlo en sitios de descargas torrent.


                    </li>
                </ul>
                </div>
            </div>

            <div class="plan-studio">
                <button class="accordion">PAGOS, CRÉDITOS Y REEMBOLSOS</button>
                <div class="panel">
                <ul>
                    <li> 
                     <p>Pagos</p>
                      Cuando realiza un pago, acepta el uso de un método de pago válido. Si no está satisfecho con el curso, ToolCreation ofrece un periodo de 30 días para el reembolso o la devolución del importe del curso en créditos en el caso de la mayoría de las compras de cursos.
                    </li>
                    <li>
                    <p>Reembolsos y créditos de reembolso</p> 
                        Si el curso que ha adquirido no es lo que esperaba, puede solicitar, en un plazo de 30 días desde la adquisición del curso, que ToolCreation realice un reembolso en su cuenta. Nos reservamos el derecho a aplicar su reembolso en forma de créditos de reembolso o de realizar un reembolso mediante su método de pago original, a su discreción, en función de las capacidades de nuestros socios de procesamiento de pagos, la plataforma en la que adquirió el curso (sitio web, o aplicación móvil o de TV) y otros factores. No se le proporcionará ningún reembolso si lo solicita transcurridos los 30 días de tiempo límite de la garantía. ToolCreation también se reserva el derecho a reembolsar a los estudiantes con posterioridad al límite de 30 días en caso de sospecha o confirmación de un fraude de cuenta.

                    </li>

                </ul>
                </div>
            </div>

            <div class="plan-studio">
                <button class="accordion">DERECHOS DE TOOLCREATION RESPECTO AL CONTENIDO QUE PUBLICA</button>
                <div class="panel">
                <ul>
                    <li> 
                    Mantiene la propiedad del contenido que publica en nuestra plataforma, incluidos sus cursos. Tenemos autorización para compartir su contenido con cualquier persona a través de cualquier medio de comunicación, incluida la promoción de su contenido mediante la publicidad en otros sitios web.
                    El contenido que publica como estudiante o instructor (incluidos los cursos) sigue siendo de su propiedad. Al publicar cursos y otro contenido, autoriza a ToolCreation a reutilizarlos y compartirlos, pero no pierde los derechos de propiedad que pueda tener sobre su contenido. Si es un instructor, asegúrese de comprender las condiciones de la licencia del curso detalladas en las Condiciones del instructor.

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
                      <li><a href="./terminos.php">Terminos</a></li>

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