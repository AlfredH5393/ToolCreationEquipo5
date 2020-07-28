const ENDPOINT_LOG_PROFESOR ="../../controller/controller_login.php";
const ENDPOINT_LOG_ALUMNO   = "../../controller/controller_login.php";
const ENPOINT_GENERADOR_COMBOS =  "../../controller/controller_data_combos.php";


var d = document;
//CLOSE.alertMessage("myalert alert-infoDanger","Archivo no valido","fas fa-exclamation bg-infoDanger");
//CLOSE.alertMessage("myalert alert-correct","Se ha eliminado el estado exitosamente","fas fa-check bg-correct")
// CLOSE.alertMessage("myalert alert-fail","El estado no pudo eliminarce" + response.data, "fas fa-times bg-fail");
const CLOSE = new Vue({
    el:"#contenedor",
    data:{
        alertgeneral: null,
        messagealert: null,
        alerticon: null,
        displayAlert: 'display:none',
        yearAccount: null,
        monthAccount: null,
        dayAccount: null,
        imgAccount: null,
        imgInfo:null,
        buttonEnable: null,
        showModal: 'display:none',
        profesorLog: false,
        comboEstancia: [],
        comboConocimiento: []

    },
    mounted: function() {
        this.setValoresAcount();
        this.comprobarLogeoProfesor();
        this.cargarComboConocimiento();
        this.cargarComboEstancia();
        this.setValoresInstructor();
     },
    methods:{
        cargarComboConocimiento: function(){
            let combos = new FormData();
            combos.append('option','instanciarConocimiento')
                axios.post(ENPOINT_GENERADOR_COMBOS, combos).then(function (response) {
                    console.log(response);
                    CLOSE.comboConocimiento = response.data.gradoConocimiento;
            })
        },
        cargarComboEstancia: function(){
            let combos = new FormData();
            combos.append('option','instanciarEstancia')
            axios.post(ENPOINT_GENERADOR_COMBOS, combos).then(function (response) {
                   console.log(response);
                   CLOSE.comboEstancia = response.data.estancia;
            })
           
        },
        comprobarLogeoProfesor: function(){
            let idUserProfesor =  d.getElementById('idUserProfesor').value;
             if(idUserProfesor >0){
                 this.profesorLog = true;
             }
        },
        setValoresInstructor: function(){
            let grado = document.getElementById('idValueGrado').value;
            let est = document.getElementById('idValueEstancia').value;
            console.log(grado+" - "+est);
            document.getElementById("idConocimiento").value =  parseInt( document.getElementById('idValueEstancia').value);
            document.getElementById("idEstancia").value =  parseInt(document.getElementById('idValueGrado').value);
        },
        setValoresAcount: function(){
            //Extraccion de valores
           
            let fechaNacimiento = d.getElementById('fechaNacimiento').value;
            let imgUser = d.getElementById('imagenUsuario').value;
            let sexoUser = d.getElementById('sexoUser').value;
            let tefofonoUser = d.getElementById('telefonoUser').value;
            let splitFecha = fechaNacimiento.split('-');
            document.getElementById('year').value = splitFecha[0];
            document.getElementById('month').value = splitFecha[1];
            document.getElementById('day').value = splitFecha[2];
            
    
            //coloacion de valores  elementos del perfil
            let combo = document.getElementById("genero");
            if(sexoUser == 'Prefiero no decirlo'){
              combo.selectedIndex = 3;
            }else if(sexoUser == 'Masculino' || sexoUser == 'M'){
              combo.selectedIndex = 1;
            }else if(sexoUser == 'Femenino' || sexoUser == 'F'){
              combo.selectedIndex = 2;
            }
            //ciolocacion de imagen  de usuario
            (imgUser === "")  ? this.imgAccount = '../../src/img/noImagen.svg' :   this.imgAccount = '../../src/img/perfilUsers/'+imgUser;
              
            //colocacion de telefono
            (tefofonoUser === "") ? document.getElementById('telefono').value = "" : document.getElementById('telefono').value = tefofonoUser;
            
        },
        updateInfoPersonal: function (){
            CLOSE.yearAccount = d.getElementById('year').value;
            CLOSE.monthAccount = d.getElementById('month').value;
            CLOSE.dayAccount = d.getElementById('day').value;
            let comboGenero = d.getElementById('genero');
            let selectedGenero = comboGenero.options[comboGenero.selectedIndex].text;
            let img = document.getElementById("customFile").files[0];
            let datos = {
                imgPerfil: img,
                nombre: d.getElementById('insert-nombre').value,
                AP: d.getElementById('insert-primerApellido').value,
                AM: d.getElementById('insert-segundoApellido').value,
                edad: d.getElementById('age').value,
                dateOfBirth: this.yearAccount+'-'+this.monthAccount+'-'+this.dayAccount,
                sexo: selectedGenero,
                telefono: d.getElementById('telefono').value,
                idUser: d.getElementById('idUser').value
            }
            if(CLOSE.camposVaciosConfigPersonal(datos)){
                CLOSE.alertMessage("myalert alert-infoDanger","Existen campos vacios, intente de nuevo","fas fa-exclamation bg-infoDanger");
      
            }else{
              let formdata = CLOSE.toFormData(datos,'accountConfig')
              axios.post(ENDPOINT_LOG_ALUMNO, formdata).then(function (response) {
                console.log(response);
                if (response.data) {
                  console.log(response.data);
                  CLOSE.alertMessage("myalert alert-correct","Se han actualizado su perfil","fas fa-check bg-correct");
                  setTimeout(function () {
                        location.reload();
                    }, 2800);
                } else {
                    CLOSE.alertMessage(
                    "myalert alert-fail",
                    "Hubo un error al  actualizar los datos" + response.data,
                    "fas fa-times bg-fail"
                  );
                }
              });
            }
          },
          updateInfoAccount: function(){
             let datos = {
                  email: d.getElementById('insert-email').value,
                  user: d.getElementById('insert-usuario').value,
                  pass: d.getElementById('insert-newPass').value,
                  idUser: d.getElementById('idUser').value
                }
            console.log(datos.pass);
            if(CLOSE.camposVaciosConfigAccount(datos)){
              CLOSE.alertMessage("myalert alert-infoDanger","Existen campos vacios, intente de nuevo","fas fa-exclamation bg-infoDanger");
      
            }else{
               let formdata = CLOSE.toFormData(datos,'accountConfigLog')
               axios.post(ENDPOINT_LOG_ALUMNO, formdata).then(function (response) {
                  console.log(response);
                  if (response.data) {
                    console.log(response.data);
                    CLOSE.alertMessage("myalert alert-correct","Se han actualizado su perfil","fas fa-check bg-correct");
                    setTimeout(function () {
                          location.reload();
                      }, 2800);
                  } else {
                      CLOSE.alertMessage(
                      "myalert alert-fail",
                      "Hubo un error al  actualizar los datos" + response.data,
                      "fas fa-times bg-fail"
                    );
                  }
               });
            }
          },
          updateInfoAccountProfesor: function(){
            let datos = {
                id: d.getElementById('idUserProfesor').value,
                conocimiento: d.getElementById('idConocimiento').value,
                estancia: d.getElementById('idEstancia').value,
              }
              if(datos.id == 0 || datos.conocimiento == 0 || datos.estancia == 0){
                CLOSE.alertMessage("myalert alert-infoDanger","Existen campos vacios, intente de nuevo","fas fa-exclamation bg-infoDanger");
        
              }else{
                 let formdata = CLOSE.toFormData(datos,'accountConfigLog')
                 axios.post(ENDPOINT_LOG_ALUMNO, formdata).then(function (response) {
                    console.log(response);
                    if (response.data) {
                      console.log(response.data);
                      CLOSE.alertMessage("myalert alert-correct","Se han actualizado su perfil","fas fa-check bg-correct");
                      setTimeout(function () {
                            location.reload();
                        }, 2800);
                    } else {
                        CLOSE.alertMessage(
                        "myalert alert-fail",
                        "Hubo un error al  actualizar los datos" + response.data,
                        "fas fa-times bg-fail"
                      );
                    }
                 });
              }
          },
          previewImage: function(e){
            CLOSE.imgInfo  = document.getElementById("customFile").files[0];
           console.log(CLOSE.imgInfo )
           if( CLOSE.imgInfo.type == "image/jpeg" ||  CLOSE.imgInfo.type == "image/png" ||  CLOSE.imgInfo.type == "image/jpg"){
               let filereader = new FileReader();
               filereader.readAsDataURL(e.target.files[0])
               filereader.onload = (e) => {
                   CLOSE.imgAccount = e.target.result
               }
           }else{
           CLOSE.alertMessage("myalert alert-infoDanger","Archivo no valido","fas fa-exclamation bg-infoDanger");
             CLOSE.imgAccount = 'src/img/noImagen.svg';
           }
        },
        camposVaciosConfigPersonal: function(caja){
         if( caja.nombre == 0 || caja.AP == 0  || caja.AM == 0  || caja.edad == 0  ||
            CLOSE.yearAccount == 0  || CLOSE.monthAccount == 0 ||  CLOSE.dayAccount == 0 || 
            caja.sexo == 'Seleccione su sexo' || caja.idUser == 0){
           return true;
           }
           return false
        },
        camposVaciosConfigAccount: function(caja){
         if( caja.email == 0 || caja.user == 0){
           return true;
           }
           return false
        },
        closeSesionRol: () => {
            let formdata = new FormData();
                        formdata.append('option','destroySesion');
                            axios.post(ENDPOINT_LOG_PROFESOR, formdata)
                                .then(function (response) {
                                    console.log(response);
                                if(response.data == "1"){
                                    window.location.href = "../../public/login.html";
                                }else{
                                    CLOSE.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                                }
                            })

                              
        },
         alertMessage: function( classe, message, iconName){
            CLOSE.alertgeneral = classe;
            CLOSE.messagealert = message;
            CLOSE.alerticon = iconName;
            CLOSE.displayAlert =""
        },
        validarSoloNumeros: function(e){
            let key = window.event ? e.which : e.keyCode;
            if(key < 48 || key > 57){
                e.preventDefault();
            }
         },
         comprobarEmail: function (){
          let comprobar = new FormData();
          comprobar.append("option","comprobarEmail");
          comprobar.append("email",d.getElementById('insert-email').value);
          axios.post(ENDPOINT_LOG_ALUMNO,comprobar).then(response =>{
                if(response.data.msj == "Existe"){
                  CLOSE.buttonEnable = true;
                  CLOSE.alertMessage("myalert alert-infoDanger","El email ya esta en uso ","fas fa-exclamation bg-infoDanger");
                    setTimeout(function () {
                        CLOSE.limpiarAlertas();
                    }, 3500);
                }else{
                  CLOSE.buttonEnable = null;
                }
               
          });
         
       },
       comprobarUser: function (){
        let comprobar = new FormData();
        comprobar.append("option","comprobarUsuario");
        comprobar.append("user",d.getElementById('insert-usuario').value);
        axios.post(ENDPOINT_LOG_ALUMNO,comprobar).then(response =>{
              if(response.data.msj == "Existe"){
                CLOSE.buttonEnable = true;
                CLOSE.alertMessage("myalert alert-infoDanger","El email ya esta en uso " ,"fas fa-exclamation bg-infoDanger");
                  setTimeout(function () {
                      CLOSE.limpiarAlertas();
                  }, 3500);
              }else{
                CLOSE.buttonEnable = null;
              }
             
        });
       
      },
      toFormData: (obj, option) => {
        let fd = new FormData();
        fd.append('option', option);
          for (let i in obj) {
            fd.append(i, obj[i]);
          }
        return fd;
      },
    }
})