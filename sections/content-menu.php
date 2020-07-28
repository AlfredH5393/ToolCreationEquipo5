<nav class="content-menu">
        <button  class="menu_close"><i class="fas fa-times"></i></button>
        <div class="option-menu">
                <a href="index.php">Inicio</a>
                <a href="#">Cursos</a>
                <a href="#">Especialidades</a>
        </div>
          
            <div class="botones-header"  v-if="!logeado">
                <a class="btn-register-log" href="./public/register.html">Registrar</a>
                <a class="btn-access-log" href="./public/login.html">ingresar</a>              
            </div>
         
</nav>