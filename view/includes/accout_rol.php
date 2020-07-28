
            <div style="display: none">
               <input type="text" name="" id="fechaNacimiento" value="<?php  echo  $_SESSION['FNacimiento'];?>" >  
               <input type="text" name="" id="sexoUser" value="<?php  echo  $_SESSION['sexo'];?>" >   
               <input type="text" name="" id="imagenUsuario" value="<?php  echo  $_SESSION['imagen'];?>" placehoder= "Imagen" >  
               <input type="text" name="" id="telefonoUser" value="<?php  echo  $_SESSION['telefono'];?>" placehoder= "Imagen" >   
               <input type="text" name="" id="idUser" value="<?php  echo  $_SESSION['ID_usuario'];?>" placehoder= "Imagen" > 
               <input type="text" name="" id="idUserProfesor" value="<?php  echo  $_SESSION['idProfesor'];?>" placehoder= "Imagen" >
               <input type="text" name="" id="idValueGrado" value="<?php  echo  $_SESSION['gradoConocimiento'];?>" placehoder= "Imagen" > 
               <input type="text" name="" id="idValueEstancia" value="<?php  echo  $_SESSION['estancia'];?>" placehoder= "Imagen" >  



            </div>
            <div class="content-profile">
                <h2>Configuración</h2>
                <div class="tabs">
                    <ul>
                        <li class="active">
                            <span class="icon">
                                <i class="far fa-user-circle"></i>
                            </span>
                            <span class="text">Informacion personal</span>
                        </li>
                        <li>
                            <span class="icon">
                                <i class="fas fa-user-cog"></i>
                            </span>
                            <span class="text">Cuenta</span>
                        </li>
                        <li v-if="profesorLog">
                            <span class="icon">
                                <i class="fas fa-user-cog"></i>
                            </span>
                            <span class="text">Datos profesor</span>
                        </li>

                    </ul>
                </div>
                <div class="container-alert" v-bind:style="displayAlert">
                        <div v-bind:class="alertgeneral" role="alert" style=" width: 60%;" >
                                <p>{{messagealert}}</p>
                                <i v-bind:class="alerticon"></i>
                        </div>
                </div>
                <div class="content-info-perfil">
            
                    <div class="tab_wrap" style="display: block;">
                        <div class="title">Información personal</div>
                        <div class="tab_content">
                            <form action="" enctype="multipart/form-data">
                                <div class="my-form-row">
                                    
                                    <img :src="imgAccount" class="cover avatar-img-profile" alt="" id="imageProfile">
                                    <div class="custom-file">
                                        <input  type="file" accept="image/*" class="custom-file-input" id="customFile" @change="previewImage">
                                        <!-- <img v-if="urlUpd" :src="urlUpd" alt="" width="200" class="mx-auto d-block m-1 img-user" > -->
                                        <!-- <label class="custom-file-label" for="customFile">Seleccione archivo</label> -->
                                    </div>
                                </div> 
                                <div class="my-form-row" >
                                        <input class="input-100 " type="text" placeholder="Nombre" value="<?php echo $_SESSION['nombre'] ?> " name="" id="insert-nombre">
                                </div>
                                <div class="my-form-row">
                                    <input class="input-50 " value="<?php echo $_SESSION['APaterno'] ?> " type="text" placeholder="Apellido paterno" name="" class="" id="insert-primerApellido">
                                    <input class="input-50 " value="<?php echo $_SESSION['AMaterno'] ?> " type="text" placeholder="Apellido materno" name="" id="insert-segundoApellido"> 

                                </div>
                                <div class="my-form-row">
                                    <input type="text" @keypress="validarSoloNumeros" placeholder="Año"  class="input-25" name="year" id="year">
                                    
                                    <input type="text"  @keypress="validarSoloNumeros" placeholder="Mes"  class="input-25" name="month" id="month">
                            
                                    <input type="text"  @keypress="validarSoloNumeros" placeholder="Dia"  class="input-25" name="day" id="day">
                                
                                    <input type="text" value="<?php echo $_SESSION['edad'] ?>" @keypress="validarSoloNumeros" placeholder="Edad" class="input-25" id="age">
                                </div>
                                <div class="my-form-row">
                                    <select name="" class="input-50" id="genero">
                                            <option value="0">Seleccione su sexo</option>
                                            <option value="1">Masculino</option>
                                            <option value="2">Femenino</option>
                                            <option value="3">Prefiero no decirlo</option>
                                        </select>
                                        <input class="input-50" type="text" name="" placeholder="Telefono(opcional)" id="telefono">
                                </div>
                            </form>
                            <div class="my-form-row">
                                <button  type="button"  class="btn btn-success "  @click= "updateInfoPersonal"  ><i class="far fa-edit" ></i> Actualizar</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab_wrap" style="display: none;">
                        <div class="title">Cuenta</div>
                        <div class="tab_content">
                        <form action="">
                            <div class="my-form-row">
                                    <input class="input-50" type="text"  value="<?php echo $_SESSION['email'] ?>" placeholder="Email" name="" @keyup="comprobarEmail" id="insert-email">  
                                    <input class="input-50" type="password"  value="<?php echo $_SESSION['password'] ?>" placeholder="Password" name="" id="insert-pass">
                            </div> 
                            <div class="my-form-row">
                                    
                                    <input class="input-50" type="text" value="<?php echo $_SESSION['usuario'] ?>" placeholder="Usuario" name="" @keyup="comprobarUser" id="insert-usuario">
                                    <input class="input-50" type="text"   placeholder="Nueva contraseña" name="" id="insert-newPass">
                            </div> 
                            
                        </form>
                        </div>
                    
                        <div class="my-form-row">
                                    <button  type="button" id="btn-updateUserAccount" class="btn btn-success "   @click= "updateInfoAccount" v-bind:disabled="buttonEnable" ><i class="far fa-edit"></i> Actualizar</button>
                            </div>
                    </div>
                    <div v-if="profesorLog" class="tab_wrap" style="display: none;">
                        <div class="title">Datos de Profesor</div>
                        <div class="tab_content">
                        <form action="">
                            <div class="my-form-row">
                            <select name="" class="input-50" id="idConocimiento">
                                            <option value="0">Seleccione su grado de conociminento</option>
                                             <option v-for="Conocimiento in comboConocimiento" v-bind:value="Conocimiento.id">{{Conocimiento.nombreGrado}}</option>
                                            
                                        </select>

                                        <select name="" class="input-50" id="idEstancia">
                                                    <option value="0">Seleccione su escuela de formacion</option>
                                                     <option v-for="Estancia in comboEstancia" v-bind:value="Estancia.id">{{Estancia.nombreEstancia}}</option> 
                                        </select>
                            </div> 
                           
                            
                        </form>
                        </div>
                    
                        <div class="my-form-row">
                                    <button  type="button" id="btn-updateUserAccountPrefosor" class="btn btn-success "   @click= "updateInfoAccountProfesor"  ><i class="far fa-edit"></i> Actualizar</button>
                            </div>
                    </div>
                    
                </div>
            </div>
  

       



