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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

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
            <h1>Jamás dejes de apreder</h1>
             <p>En ToolCreation  contamos con varios cursos del sector Tecnoligia, inicia para que no te quedes fuera</p>
             <img src="./src/img/lear1.svg" alt="">
             <p>
                <a class="explore" href="">Explorar cursos</a>
             </p>
           
        </section>

        <section class="services-section">
            <div class="inner-width">
              <h2>¿Qué puedo <strong>aprender</strong> aquí?</h2>
              <div class="services owl-carousel">
      
                <div class="service">
                  <div class="service-icon">
                    <img src="src/img/ux.svg" alt="">
                  </div>
                  <div class="service-name">Design UI / UX</div>
                  <div class="service-desc">Descubrirás los fundamentos en UX & UI, conociendo qué es cada uno a fondo, las diferencias, similitudes y aplicación profesional</div>
                </div>
      
                
      
                <div class="service">
                  <div class="service-icon">
                    <img src="src/img/ui.svg" alt="">
                  </div>
                  <div class="service-name">Contuccion de sitios WEB</div>
                  <div class="service-desc">Domina HTML, CSS y JavaScript en el frontend. JavaScript, Go, Ruby y más en el backend</div>
                </div>
      
                <div class="service">
                  <div class="service-icon">
                    <img src="src/img/base-de-datos.svg" alt="">
                  </div>
                  <div class="service-name">Bases de datos</div>
                  <div class="service-desc">Domina el lenguaje SQL para cada uno de los gestores, para poder mainupular datos de manera eficiente</div>
                </div>
      
                <div class="service">
                  <div class="service-icon">
                    <img src="src/img/telefono-inteligente.svg" alt="">
                  </div>
                  <div class="service-name">Creacion de Apps </div>
                  <div class="service-desc">Vuélvete un experto desarrollando apps para Android y iOS.</div>
                </div>

                <div class="service">
                    <div class="service-icon">
                        <img src="src/img/velocidad.svg" alt="">

                    </div>
                    <div class="service-name">Vuelvete un Pro</div>
                    <div class="service-desc">Desarrolla tus habilidades y estarás listo para trabajar en una empresa.</div>
                  </div>

              </div>
            </div>
          </section>

          <section class="about-section">
            <div class="inner-container">
                <h1>Sobre nosotros</h1>
                <p class="text">
                    ToolCreation es una empresa de educacion <strong>online</strong>,  nace a raiz de la necesidad de las personas  que desean aprender, emprender o  refozar conocimientos del sector de la cienca y la tecnología
                    , personas que  realmente quieren adquirir conocimietos para poder adapatarce al futuro.
                </p>
                <div class="skills">
                    <span>Apredizaje</span>
                    <span>Dedicacion</span>
                    <span>Codigo</span>
                    <span>Esfuerzo</span>

                </div>
            </div>
        </section>

        <section class="cursos-top">
            <h2>Cursos Recientes</h2>
            <div class="cards-content-curso">

                <div  v-for="curso in cursosRecent " class="card-curso">
                    <div class="card-curso-header">
                        <img v-bind:src="'src/img/bannerscursos/'+ curso.imgCurso" alt="">
                    </div>
                    <div class="card-curso-body">
                        <div class="date-published">{{getDateHuman(curso.dateModificacion.date)}} <span><i class="fas fa-calendar"></i></span></div>
                        <h3>{{curso.nombre}}</h3>
                        <p>{{curso.descripcion}}</p>
                        <div class="instructor">
                            <img class="avatar-profesor" v-bind:src="'src/img/perfilUsers/'+ curso.imgUser" alt="">
                            <p>{{curso.instructor}}</p>
                            <button type="button" class="btn show-curso" @click="irdetallecurso(curso.id)">Ir a ver</button>
                        </div>
                    </div>
                    <div class="card-curso-foot">
                        <div class="stant">
                            <div class="item-stat1">
                                <div class="value">4hr <span><i class="fas fa-clock"></i></span></div>
                                <div class="type">Duracion</div>
                            </div>
                            <div class="item-stat2">
                                <div class="value">{{curso.incritos}} <span><i class="fas fa-user"></i></span></div>
                                <div class="type">Alumnos</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
           
        </section>
        
        <section class="category">
            <h2>Categorias</h2>
            <div class="content-categories">
               
                    <div class="card-categores">
                        <span><i class="fas fa-code"></i> Desarollo </span>
                    </div>
               

               
                <div class="card-categores">
                    <span><i class="fas fa-pen"></i> Diseño </span>
                </div>
         

               <div class="card-categores">
                    <span><i class="fas fa-ruler-combined"></i> Matematicas </span>
                </div>

                <div class="card-categores">
                    <span><i class="fas fa-database"></i> Base de datos </span>
                </div>
            </div>
        </section>

        <section class="certificados">
            <h2>Certificados digitales</h2>
            <p>Los certificados son formaton digitales que se otorgan final de los cursos y certficaciones, son un impulso motivante para ti.</p>
            <img src="src/img/contrato.svg" alt="">
          
        </section>
        
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
     <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
     <script src="src/js/cliente_plataform.js"></script>
     <script src="src/js/menu_principal.js"></script>
     <script src="src/js/dropdown.js"></script>
     <script src="src/js/jquery-3.5.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" charset="utf-8"></script>
    
    <script>
        $(".services").owlCarousel({
          margin:20,
          loop:true,
          autoplay:true,
          autoplayTimeout:2000,
          autoplayHoverPause:true,
          responsive:{
            0:{
              items:1
            },
            600:{
              items:2
            },
            1000:{
              items:3
            }
          }
        });
      </script>
     
</body>
</html>