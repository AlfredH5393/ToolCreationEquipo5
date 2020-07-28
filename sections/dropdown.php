
<div class="botones-header"  v-if="logeado">
            <a href="#" class="avatar"><img <?php $nameImg=$_SESSION['imagen'];
                $nameImg != null ?  $varSrc='src="src/img/perfilUsers/'.$nameImg.'"':  $varSrc='src="src/img/persona.svg"' ;
                echo $varSrc;
                ?>  alt= ""></a>
                <div id="dropdown" class="dropdown">
                       <div class="info-perfil">
                                            <img  <?php $nameImg=$_SESSION['imagen'];
                                                   $nameImg != null ?  $varSrc='src="src/img/perfilUsers/'.$nameImg.'"':  $varSrc='src="src/img/persona.svg"' ;
                                                  echo $varSrc;
                                                ?>  alt="">
                                            <p class="name"><?php echo $_SESSION['nombre'].' '. $_SESSION['APaterno'].' '.$_SESSION['AMaterno']  ?> </p>
                                            <p class="email"><?php echo  $_SESSION['email']?></p>
                                            <p class="user"><?php echo  $_SESSION['usuario']?></p>
                    
                        </div>

                                        <hr>
                        <ul>
                                        <li>
                                            <a  href="acount.php" ><i class="fas fa-user"></i> Cuenta</a>
                                        </li>
                                        <!-- <li>
                                            <a href="#"><i class="fas fa-sliders-h"></i> Configuracion</a>
                                        </li> -->
                                        
                                        <li>
                                            <a href="#" @click="closeSesionRol()"><i class="fas fa-sign-out-alt"></i> Salir </a>
                                        </li>
                                    
                        </ul>
                  </div>
</div>
