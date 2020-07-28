<nav class="side-bar">
        <?php
        if($_SESSION['idRol'] == "1"){  
        ?>
            
            <a class="<?php if($page == 'home'){echo 'active';} ?>" href="index.php" ><i class="fas fa-home"></i> Inicio</a>
            <a class="<?php if($page == 'plataforma'){echo 'active';} ?>" href="plataformas.php"><i class="fas fa-globe-americas"></i> Plataforma</a>
            <!-- <a class="" href="#"><i class="fas fa-school"></i> Estudiantes</a> -->
            <a class="<?php if($page == 'moneda'){echo 'active';} ?>" href="moneda.php"><i class="fas fa-coins"></i> moneda</a>
            <a class="<?php if($page == 'roles'){echo 'active';} ?>" href="roles.php"><i class="fas fa-user-cog"></i> Roles</a>

            <hr>
            <a class="<?php if($page == 'tipoPromocion'){echo 'active';} ?>" href="tipopromocion.php"> <i class="fas fa-tags"></i> Tipo de promociones</a>
            <a class="<?php if($page == 'categorias'){echo 'active';} ?>" href="categorias.php"> <i class="fas fa-list"></i> Categorias</a>
            <a class="<?php if($page == 'estadoCurso'){echo 'active';} ?>" href="estadocurso.php"> <i class="fas fa-book"></i> Estado curso</a>
            <a class="<?php if($page == 'estadoTema'){echo 'active';} ?>" href="estadotema.php"><i class="fas fa-book-open"></i> Estado tema</a>
            <a class="<?php if($page == 'estadoUser'){echo 'active';} ?>" href="estadousuario.php"><i class="fas fa-user-cog"></i> Estado Usuario</a>
            <hr>
            <a class="<?php if($page == 'estancia'){echo 'active';} ?>" href="estancia.php"><i class="fas fa-building"></i> Estancia instructor</a>
            <a class="<?php if($page == 'nivelEstudios'){echo 'active';} ?>" href="gradoconocimiento.php"><i class="fas fa-user-graduate"></i> Nivel de Estudio</a>
            <a class="<?php if($page == 'nivelCursos'){echo 'active';} ?>" href="niveldecurso.php"><i class="fas fa-chart-bar"></i> Nivel de curso</a>
            <a class="<?php if($page == 'tipoRecurso'){echo 'active';} ?>" href="tiporecursos.php"><i class="fas fa-folder-open"></i> Tipo de recurso</a>
            <a class="<?php if($page == 'tipoVideo'){echo 'active';} ?>" href="tipovideo.php"><i class="fas fa-file-video"></i> Tipo de video</a>

        <?php
        }else{
        ?>
            <a class="<?php if($page == 'home'){echo 'active';} ?>" href="index.php" ><i class="fas fa-home"></i> Inicio</a>
            <a class="<?php if($page == 'cursos'){echo 'active';} ?>" href="cursos.php" ><i class="fas fa-photo-video"></i> cursos</a>
        
        <?php
            }
         ?>
</nav>