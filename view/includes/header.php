<header class="header">
            <div class="content-logo">
                <button id="btn-menu" class="btn-menu"><i class="fas fa-bars"></i></button>
                <?php
                         if( $_SESSION['idRol'] == "1"){
                 ?>
                <img src="../src/img/Logo-ToolCreatiion2.png" width="110" height="70" alt="">
                <?php
                         }else{
                 ?>
                <img src="../../src/img/Logo-ToolCreatiion2.png" width="110" height="70" alt="">

                    <?php
                          }
                    ?>
            </div>

            <div class="barra-busqueda">
                 <?php
                         if( $_SESSION['idRol'] == "1"){
                 ?>
                        <h2>Admin Dashboard</h2>
                <?php
                         }else{
                 ?> 
                         <h2>Profesor Dashboard</h2>
                 <?php
                          }
                 ?>
               
            </div>

            <div class="botones-header">
                <?php
                         if( $_SESSION['idRol'] == "1"){
                 ?>
                <a href="#" class="avatar"><img
                <?php $nameImg=$_SESSION['imagen'];
                echo $varSrc='src="../src/img/perfilUsers/'.$nameImg.'"';
                ?>
                alt= ""></a>
                <div id="dropdown" class="dropdown">
                <div class="info-perfil">
                               <img <?php $nameImg=$_SESSION['imagen'];
                                    echo $varSrc='src="../src/img/perfilUsers/'.$nameImg.'"';
                                    ?> alt="">
                               <p class="name"><?php echo $_SESSION['nombre'].' '. $_SESSION['APaterno'].' '.$_SESSION['AMaterno']  ?> </p>
                               <p class="email"><?php echo  $_SESSION['email']?></p>
                               <p class="user"><?php echo  $_SESSION['usuario']?></p>
    
                  </div>

                  <?php
                         }else{
                 ?> 
                <a class="btn btn-back-student" href="../../index.php">Estudiante</a> 
                <a href="#" class="avatar"><img 
                <?php $nameImg=$_SESSION['imagen'];
                echo $varSrc='src="../../src/img/perfilUsers/'.$nameImg.'"';
                ?>
               alt= ""></a>
                <div id="dropdown" class="dropdown">
                <div class="info-perfil">
                               <img  <?php $nameImg=$_SESSION['imagen'];
                                echo $varSrc='src="../../src/img/perfilUsers/'.$nameImg.'"';
                                ?> alt="">
                               <p class="name"><?php echo $_SESSION['nombre'].' '. $_SESSION['APaterno'].' '.$_SESSION['AMaterno']  ?> </p>
                               <p class="email"><?php echo  $_SESSION['email']?></p>
                               <p class="user"><?php echo  $_SESSION['usuario']?></p>
    
                  </div>
                    <?php
                          }
                    ?>
                           <hr>
                    <ul>
                        
                        <!-- <li><a  href="#" @click="closeSesion()">Salir</a></li> -->
                        <?php
                         if( $_SESSION['idRol'] == "1"){
                        ?>
                        <li><a  href="#" @click="closeSesion()"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
                        <?php
                         }else{
                        ?>
                        <li>
                            <a  href="acount.php" ><i class="fas fa-user"></i> Cuenta</a>
                        </li>
                        <li>
                            <a href="#" @click="closeSesionRol"><i class="fas fa-sign-out-alt"></i> Salir </a>
                        </li>
                        <?php
                          }
                        ?>
                    </ul>
                </div>
            </div>
</header>