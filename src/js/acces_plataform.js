// import  clsCerrarSesion from '../js/class/cerrar_sesion.js';
const URL = "../controller/controller_login.php";
const EMAIL ="../controller/controller_correo.php";
const d = document;
var datos;

const LOGIN = new Vue({
    el:"#contenedor",
    data:{
        title: "Iniciar sesión",
        alerticon: null,
        alertgeneral: null,
        messagealert: null,
        btnIniciar: 'INICIAR',
        btnRegister: 'Registrarme',
        iconRfresh: null,
        displayAlert: 'display:none',buttonEnable: false
        
    },
    mounted: function(){
       
    },
    methods:{
        iniciar: () => {
            let formLogIn = d.getElementById("form-log-in");
            let elementos = formLogIn.elements;
         
            datos = {
                email : elementos.email.value,
                password: elementos.password.value,
               
            }
            //zac@gmail.com 56456
           if(LOGIN.validarCamposVaciosAccess(elementos)){
               console.log("valide campos")
           }else{
               let formdata = LOGIN.toFormData(datos, 'autenticacion');
            axios.post(URL, formdata)
            .then(function (response) {
                console.log(response);
                LOGIN.btnIniciar = null;
                LOGIN.iconRfresh = "fas fa-redo-alt fa-spin fa-2x";
                if(response.data == "1"){
                     window.location.href = "../view/index.php";
                } else if(response.data == "11"){
                    window.location.href = "../index.php";
                }else if(response.data == "NA"){
                    LOGIN.alertMessage("myalert alert-fail","Su contraseña es incorrecta " + response.data, "fas fa-times bg-fail");
                    LOGIN.btnIniciar = "INICIAR";
                    LOGIN.iconRfresh = null;
                }else{
                    LOGIN.alertMessage("myalert alert-fail","Hubi un error en su datos, verifiquelos" + response.data, "fas fa-times bg-fail");
                    LOGIN.btnIniciar = "INICIAR";
                    LOGIN.iconRfresh = null;
                }
            })
            
           }
        },
        register: () => {
            let formRegister = d.getElementById("msform");
            let elemento = formRegister.elements;
            let fechaNacimiento = elemento.year.value +"-"+elemento.month.value+"-"+ elemento.day.value;
            let sexoSeleccionado = LOGIN.selectGenero(d.getElementById('hombre'), d.getElementById('mujer'),d.getElementById('preferNotSay'))
            datos = {
                nombre: elemento.nombre.value,
                AP: elemento.AP.value,
                AM: elemento.AM.value,
                dateOfBirth: fechaNacimiento,
                edad: elemento.age.value,
                sexo: sexoSeleccionado,
                email: elemento.email.value,
                usuario: elemento.usuario.value,
                password: elemento.password.value,
                password2: elemento.password2.value
            }

            if(LOGIN.validarCamposRegister(elemento)){
                console.log("valide campos")
            }else if(LOGIN.valildarRadiosVacios(d.getElementById('hombre'), d.getElementById('mujer'), d.getElementById('preferNotSay'))){
                LOGIN.alertMessage("myalert alert-infoDanger","No ha seleccionado su sexo","fas fa-exclamation bg-infoDanger");
            }else{
                if(datos.password2 == datos.password){
                    let formdata = LOGIN.toFormData(datos, 'register');
                    axios.post(URL, formdata)
                        .then(function (response) {
                            console.log(response);
                            LOGIN.btnRegister = null;
                            LOGIN.iconRfresh = "fas fa-redo-alt fa-spin fa-2x";
                            if(response.data){
                                LOGIN.btnRegister = "Registrarme";
                                LOGIN.iconRfresh = null;
                                LOGIN.alertMessage("myalert alert-correct","Bienvenido a ToolCreation sus datos han sido registrados ","fas fa-check bg-correct")        
                                LOGIN.limpiarFormRegistro(elemento, 'sexo');
                                setTimeout(function () {
                                    LOGIN.limpiarAlertas();
                                   }, 3000)
                            }else{
                                LOGIN.alertMessage("myalert alert-fail","Hubo un error en sus datos, el correo o nombre de usuario ya estan en uso " + response.data, "fas fa-times bg-fail");
                                LOGIN.btnRegister = "Registrarme";
                                LOGIN.iconRfresh = null;
                            }
                    })
                }else {
                    LOGIN.alertMessage("myalert alert-infoDanger","La contraseñas no coinciden","fas fa-exclamation bg-infoDanger");
                }
               
            }
            
        },
        recuperarPass: function(){
            datos ={
                email: d.getElementById("insert-email").value,
            }

            if(datos.email == 0){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo email  esta vacio","fas fa-exclamation bg-infoDanger");
                 setTimeout(function () {
                    LOGIN.limpiarAlertas();
                  }, 2500); 
            }else{
                let formdata = LOGIN.toFormData(datos, '');
                axios.post(EMAIL,formdata).then(response =>{
                    console.log(response.data)
                    if(response.data){
                      LOGIN.buttonEnable = true;
                      LOGIN.alertMessage("myalert alert-correct","Hemos enviado un correo con tu nueva contraseña ","fas fa-check bg-correct");
                        setTimeout(function () {
                          LOGIN.limpiarAlertas();
                        }, 2500);
                    }else{
                        LOGIN.alertMessage("myalert alert-fail","Hubo un error al restablecer su contraseña, el correo no es valido" + response.data, "fas fa-times bg-fail");
                    }
                   
              });
            }
        },
        //-------------validaciones--------------
        selectGenero: function(men,woman,notSay){
            let genero;
            if(men.checked === true){
               genero = "Masculino" 
            }
            if(woman.checked === true){
                genero = "Femenino";
            }
            if(notSay.checked === true){
                genero = "Prefiero no decirlo"
            }
            return genero;
        },
        validarCamposVaciosAccess: function(datos){
            if(datos.email.value == 0 || LOGIN.validarEspaciosVacios(datos.email.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo email esta vacio","fas fa-exclamation bg-infoDanger");
                datos.email.value = "";
                datos.email.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.password.value == 0 || LOGIN.validarEspaciosVacios(datos.password.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo password esta vacio","fas fa-exclamation bg-infoDanger");
                datos.password.value = "";
                datos.password.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }
            return false;
        },
        validarCamposRegister: function(datos){
            if(datos.nombre.value == 0 || LOGIN.validarEspaciosVacios(datos.nombre.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo nombre esta vacio","fas fa-exclamation bg-infoDanger");
                datos.nombre.value = "";
                datos.nombre.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.AP.value == 0 || LOGIN.validarEspaciosVacios(datos.AP.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo apellido paterno esta vacio","fas fa-exclamation bg-infoDanger");
                datos.AP.value = "";
                datos.AP.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.AM.value == 0 || LOGIN.validarEspaciosVacios(datos.AM.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo apellido materno esta vacio","fas fa-exclamation bg-infoDanger");
                datos.AM.value = "";
                datos.AM.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }
            if(datos.year.value == 0 || LOGIN.validarEspaciosVacios(datos.year.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo año esta vacio","fas fa-exclamation bg-infoDanger");
                datos.year.value = "";
                datos.year.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.month.value == 0 || LOGIN.validarEspaciosVacios(datos.month.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo mes esta vacio","fas fa-exclamation bg-infoDanger");
                datos.month.value = "";
                datos.month.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.day.value == 0 || LOGIN.validarEspaciosVacios(datos.day.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo dia esta vacio","fas fa-exclamation bg-infoDanger");
                datos.day.value = "";
                datos.day.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.age.value == 0 || LOGIN.validarEspaciosVacios(datos.age.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo edad esta vacio","fas fa-exclamation bg-infoDanger");
                datos.age.value = "";
                datos.age.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.email.value == 0 || LOGIN.validarEspaciosVacios(datos.email.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo email esta vacio","fas fa-exclamation bg-infoDanger");
                datos.email.value = "";
                datos.email.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }
            if(datos.usuario.value == 0 || LOGIN.validarEspaciosVacios(datos.usuario.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo usuario esta vacio","fas fa-exclamation bg-infoDanger");
                datos.usuario.value = "";
                datos.usuario.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.password.value == 0 || LOGIN.validarEspaciosVacios(datos.password.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo contraseña esta vacio","fas fa-exclamation bg-infoDanger");
                datos.password.value = "";
                datos.password.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }

            if(datos.password2.value == 0 || LOGIN.validarEspaciosVacios(datos.password2.value) === true){
                LOGIN.alertMessage("myalert alert-infoDanger","El campo repetir contraseña esta vacio","fas fa-exclamation bg-infoDanger");
                datos.password2.value = "";
                datos.password2.focus();
                return true;
            }else{
                LOGIN.limpiarAlertas();
            }
            
            return false;
        },
        valildarRadiosVacios: function (men,woman,notSay){
            if(men.checked || woman.checked || notSay.checked  ){
               return false
             }
            return true;
        }, 
        validarEspaciosVacios: function(campo){
            let patron = /^\s+$/;
            if(patron.test(campo)){
             return true;
            }
            return false
         },
         validarSoloNumeros: function(e){
            let key = window.event ? e.which : e.keyCode;
            if(key < 48 || key > 57){
                e.preventDefault();
            }
         },
        alertMessage: function( classe, message, iconName){
            LOGIN.displayAlert ="";
            LOGIN.alertgeneral = classe;
            LOGIN.messagealert = message;
            LOGIN.alerticon = iconName;
        },
        limpiarAlertas: function (){
            LOGIN.alertgeneral = null;
            LOGIN.messagealert = null; 
            LOGIN.alerticon = null;
            LOGIN.displayAlert = "display:none"
        },
        limpiarFormRegistro: function (elemento, groupNameRadio){
             elemento.nombre.value = "";
             elemento.AP.value = "";
             elemento.AM.value = "",
             elemento.year.value = "";
             elemento.month.value = "";
             elemento.day.value = "";
             elemento.age.value = "";
             elemento.email.value = "";
             elemento.usuario.value = "";
             elemento.password.value = "";
             elemento.password2.value = "";
             let arRadioBtn = d.getElementsByName(groupNameRadio);
             for( let i = 0; i < arRadioBtn.length; i++){
                 let radButton = arRadioBtn[i];
                 radButton.checked = false;
             }

        },
        toFormData: (obj, option) => {
            let fd = new FormData();
            fd.append('option', option);
              for (let i in obj) {
                fd.append(i, obj[i]);
              }
            return fd;
        },
        comprobarEmail: function (){
            let comprobar = new FormData();
            comprobar.append("option","comprobarEmail");
            comprobar.append("email",d.getElementById('insert-email').value);
            axios.post(URL,comprobar).then(response =>{
                  if(response.data.msj == "Existe"){
                    LOGIN.buttonEnable = true;
                    LOGIN.alertMessage("myalert alert-infoDanger","El email ya esta en uso ","fas fa-exclamation bg-infoDanger");
                      setTimeout(function () {
                        LOGIN.limpiarAlertas();
                      }, 3500);
                  }else{
                    LOGIN.buttonEnable = null;
                  }
                 
            });
           
         },
         comprobarUser: function (){
          let comprobar = new FormData();
          comprobar.append("option","comprobarUsuario");
          comprobar.append("user",d.getElementById('insert-usuario').value);
          axios.post(URL,comprobar).then(response =>{
                if(response.data.msj == "Existe"){
                    LOGIN.buttonEnable = true;
                    LOGIN.alertMessage("myalert alert-infoDanger","El usuario ya esta en uso " ,"fas fa-exclamation bg-infoDanger");
                    setTimeout(function () {
                        LOGIN.limpiarAlertas();
                    }, 3500);
                }else{
                    LOGIN.buttonEnable = null;
                }
               
          });
         
        },
        comprobarEmailRecuperacion: function (){
            let comprobar = new FormData();
            comprobar.append("option","comprobarEmail");
            comprobar.append("email",d.getElementById('insert-email').value);
            axios.post(URL,comprobar).then(response =>{
                  if(response.data.msj == "No existe"){
                    LOGIN.buttonEnable = true;
                    LOGIN.alertMessage("myalert alert-infoDanger","El email no esta registrado ","fas fa-exclamation bg-infoDanger");
                      setTimeout(function () {
                        LOGIN.limpiarAlertas();
                      }, 3500);
                  }else{
                    LOGIN.buttonEnable = null;
                  }
                 
            });
           
         },
    },


})