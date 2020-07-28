const ENDPOINT_CURSOS = "../../controller/controller_curso.php";
const ENDPOINT_LOG_PROFESOR = "../../controller/controller_login.php";
const ENPOINT_GENERADOR_COMBOS =  "../../controller/controller_data_combos.php";
//CURSOS.alertMessage("myalert alert-infoDanger","Archivo no valido","fas fa-exclamation bg-infoDanger");
//CURSOS.alertMessage("myalert alert-correct","Se ha eliminado el estado exitosamente","fas fa-check bg-correct")
//CURSOS.alertMessage("myalert alert-fail","El estado no pudo eliminarce" + response.data, "fas fa-times bg-fail");
//CURSOS.iconRfresh = "fas fa-redo-alt fa-spin fa-2x";
var d = document;
const CURSOS = new Vue({
    el:"#contenedor",
    data:{
        titleModule: 'Cursos',
        alertgeneral: null,
        messagealert: null,
        alerticon: null,
        displayAlert: "display:none",
        iconRfresh: null,
        listCursos: null,
        comboMoneda: [],
        comboNivel:[],
        comboCategoria:[],
        imgAccount: null,
        imgAccountUpdate: null,
        imgInfo:null

    },
    mounted: function() {
        this.cargarComboCategoria();
        this.cargarComboMoneda();
        this.cargarComboNivel();
        this.cargarCursos();
    },
    methods: {
        getDateHuman:function (dateAPI){
            return moment(dateAPI, "YYYYMMDD").fromNow();
        },
        cargarComboNivel: function(){
            
            let combos = new FormData();
            combos.append('option','instanciarNivel')
                axios.post(ENPOINT_GENERADOR_COMBOS, combos).then(function (response) {
                    console.log(response);
                    CURSOS.comboNivel = response.data.estadoNivel;
            })
        },
        cargarComboCategoria: function(){
            let combos = new FormData();
            combos.append('option','instanciarCategoria')
            axios.post(ENPOINT_GENERADOR_COMBOS, combos).then(function (response) {
                   console.log(response);
                   CURSOS.comboCategoria = response.data.categoria;
            })
           
        },
        
        cargarComboMoneda: function(){
            let combos = new FormData();
            combos.append('option','instanciarMoneda')
                axios.post(ENPOINT_GENERADOR_COMBOS, combos).then(function (response) {
                    console.log(response);
                    CURSOS.comboMoneda = response.data.moneda;
            })
           
        },
        cargarCursos: function(){
            let data = new FormData();
            data.append('option','showData')
            data.append('idProfesor', d.getElementById('idProfesor').value)
                axios.post(ENDPOINT_CURSOS, data).then(function (response) {
                    console.log(response);
                    CURSOS.listCursos = response.data.curso;
            })
        },
        insertar: function (){
          let verifySelectedImg = document.getElementById("customFile").value;
          let getImgCurso = document.getElementById("customFile").files[0]
          let datos= {
              nombre : d.getElementById('insert-nombre').value,
              conocimiento : d.getElementById('insert-conocimiento').value,
              requisitos : d.getElementById('insert-requisitos').value,
              descripcion : d.getElementById('insert-descripcion').value,
              categoria : d.getElementById('combo-categoria').value,
              nivel : d.getElementById('combo-nivel').value,
              precio : d.getElementById('insert-precio').value,
              moneda : d.getElementById('combo-moneda').value,
              instructor: d.getElementById('idProfesor').value,
              imgCurso : getImgCurso,
          }
          if(CURSOS.validarCamposInsert(datos)){
            CURSOS.alertMessage("myalert alert-infoDanger","Existen campos vacios","fas fa-exclamation bg-infoDanger"); 
          }else if(CURSOS.validarImgSelected(verifySelectedImg)){
                CURSOS.alertMessage("myalert alert-infoDanger","Seleccione una imagen","fas fa-exclamation bg-infoDanger");
          }else if(CURSOS.validarTypeImagen(getImgCurso)){
            CURSOS.alertMessage("myalert alert-infoDanger","Seleccione una imagen valida JPG, PNG, JPEG","fas fa-exclamation bg-infoDanger");
          }else{
              let formdata = CURSOS.toFormData(datos, 'insert');
              axios.post(ENDPOINT_CURSOS, formdata).then(function (response) {
                console.log(response);
                if(response.data){
                    console.log(response.data)
                    CURSOS.limpiarCampos();
                    CURSOS.alertMessage("myalert alert-correct","El curso se ha registrado exitosamente","fas fa-check bg-correct")
                    CURSOS.cargarCursos();
                    setTimeout(function() {
                       CURSOS.limpiarAlertas();     
                    },3000);
                }else{
                    CURSOS.alertMessage("myalert alert-fail","El curso no pudo registrarce " + response.data, "fas fa-times bg-fail");
                }
              })
          }
        },
        update: function(){
            // let verifySelectedImg = document.getElementById("customFile-update").value;
            let getImgCurso = document.getElementById("customFile-update").files[0]
            let datos= {
                idCurso: d.getElementById('update-idcurso').value,
                nombre : d.getElementById('update-nombre').value,
                conocimiento : d.getElementById('update-conocimiento').value,
                requisitos : d.getElementById('update-requisitos').value,
                descripcion : d.getElementById('update-descripcion').value,
                categoria : d.getElementById('update-combo-categoria').value,
                nivel : d.getElementById('update-combo-nivel').value,
                precio : d.getElementById('update-precio').value,
                moneda : d.getElementById('update-combo-moneda').value,
                imgCurso : getImgCurso,
            }
            if(CURSOS.validarCamposInsert(datos)){
              CURSOS.alertMessage("myalert alert-infoDanger","Existen campos vacios","fas fa-exclamation bg-infoDanger"); 
            }else{
                let formdata = CURSOS.toFormData(datos, 'update');
                axios.post(ENDPOINT_CURSOS, formdata).then(function (response) {
                  console.log(response);
                  if(response.data){
                      console.log(response.data)
                      CURSOS.limpiarCampos();
                      CURSOS.alertMessage("myalert alert-correct","El curso se ha actualizado exitosamente","fas fa-check bg-correct")
                      CURSOS.cargarCursos();
                      setTimeout(function() {
                         CURSOS.limpiarAlertas();     
                      },3000);
                  }else{
                      CURSOS.alertMessage("myalert alert-fail","El curso no pudo actualizarce " + response.data, "fas fa-times bg-fail");
                  }
                })
            }
        },
        eliminar: function(){
            let datos= {
                idCurso: d.getElementById('delete-id').value,
            }
            if(datos.idCurso == 0){
                CURSOS.alertMessage("myalert alert-infoDanger","Existen campos vacios","fas fa-exclamation bg-infoDanger"); 
              }else{
                  let formdata = CURSOS.toFormData(datos, 'delete');
                  axios.post(ENDPOINT_CURSOS, formdata).then(function (response) {
                    console.log(response);
                    if(response.data == ""){
                        console.log(response.data)
                        CURSOS.limpiarCampos();
                        CURSOS.alertMessage("myalert alert-correct","El curso se ha inhabilitado exitosamente","fas fa-check bg-correct")
                        CURSOS.cargarCursos();
                        setTimeout(function() {
                           CURSOS.limpiarAlertas();     
                        },3000);
                    }else{
                        CURSOS.alertMessage("myalert alert-fail","El curso no pudo inhabilitarce " + response.data, "fas fa-times bg-fail");
                    }
                  })
              }
        },
        publicar: function(){
            let datos= {
                idCurso: d.getElementById('publish-id').value,
            }
            if(datos.idCurso == 0){
                CURSOS.alertMessage("myalert alert-infoDanger","Existen campos vacios","fas fa-exclamation bg-infoDanger"); 
              }else{
                  let formdata = CURSOS.toFormData(datos, 'publish');
                  axios.post(ENDPOINT_CURSOS, formdata).then(function (response) {
                    console.log(response);
                    if(response.data ==""){
                        console.log(response.data)
                        CURSOS.limpiarCampos();
                        CURSOS.alertMessage("myalert alert-correct","El curso se ha Publicado exitosamente","fas fa-check bg-correct")
                        CURSOS.cargarCursos();
                        setTimeout(function() {
                           CURSOS.limpiarAlertas();     
                        },3000);
                    }else{
                        CURSOS.alertMessage("myalert alert-fail","El curso no pudo publicarce " + response.data, "fas fa-times bg-fail");
                    }
                  })
              }
        },
        restaurar: function(){
            let datos= {
                idCurso: d.getElementById('restaurar-id').value,
            }
            if(datos.idCurso == 0){
                CURSOS.alertMessage("myalert alert-infoDanger","Existen campos vacios","fas fa-exclamation bg-infoDanger"); 
              }else{
                  let formdata = CURSOS.toFormData(datos, 'restaurar');
                  axios.post(ENDPOINT_CURSOS, formdata).then(function (response) {
                    console.log(response);
                    if(response.data ==""){
                        console.log(response.data)
                        CURSOS.limpiarCampos();
                        CURSOS.alertMessage("myalert alert-correct","El curso se ha restaurado exitosamente","fas fa-check bg-correct")
                        CURSOS.cargarCursos();
                        setTimeout(function() {
                           CURSOS.limpiarAlertas();     
                        },3000);
                    }else{
                        CURSOS.alertMessage("myalert alert-fail","El curso no pudo restaurarce " + response.data, "fas fa-times bg-fail");
                    }
                  })
              }
        },
        setDatos: function(curso){
            d.getElementById('update-idcurso').value = curso.id;
            d.getElementById('update-nombre').value = curso.nombre ;
            d.getElementById('update-conocimiento').value = curso.conocimiento ;
            d.getElementById('update-requisitos').value = curso.requisitos;
            d.getElementById('update-descripcion').value = curso.descripcion;
            d.getElementById('update-combo-categoria').value = curso.categoria;
            d.getElementById('update-combo-nivel').value = curso.nivel;
            d.getElementById('update-precio').value = curso.precio;
            d.getElementById('update-combo-moneda').value = curso.moneda;
            CURSOS.imgAccountUpdate = "../../src/img/bannerscursos/" + curso.imgCurso;
        },
        setDatosEliminar: function(curso){
            d.getElementById('delete-id').value = curso.id;
            d.getElementById('delete-nombre').value = curso.nombre ;
        },
        setDatosPublish: function(curso){
            d.getElementById('publish-id').value = curso.id;
            d.getElementById('publish-nombre').value = curso.nombre ;
        },
        setDatosRestaurar: function(curso){
            d.getElementById('restaurar-id').value = curso.id;
            d.getElementById('restaurar-nombre').value = curso.nombre ;
        },
        irdetallecurso: function(id){
            let valor = 'idcurso='+id; 
            window.location.href = 'tema.php?'+valor;
        },
        toFormData: (obj, option) => {
            let fd = new FormData();
            fd.append('option', option);
              for (let i in obj) {
                fd.append(i, obj[i]);
              }
            return fd;
        },
        alertMessage: function( classe, message, iconName){
            CURSOS.displayAlert ="";
            CURSOS.alertgeneral = classe;
            CURSOS.messagealert = message;
            CURSOS.alerticon = iconName;
        },
        limpiarAlertas: function (){
            CURSOS.alertgeneral = null;
            CURSOS.messagealert = null; 
            CURSOS.alerticon = null;
            CURSOS.displayAlert = "display:none"
        },
        limpiarCampos: function (){
                //  d.getElementById("customFile").value ="";
                 d.getElementById('insert-nombre').value ="",
                 d.getElementById('insert-conocimiento').value ="",
                 d.getElementById('insert-requisitos').value ="",
                 d.getElementById('insert-descripcion').value ="",
                 d.getElementById('combo-categoria').value ="",
                 d.getElementById('combo-nivel').value ="",
                 d.getElementById('insert-precio').value ="",
                 d.getElementById('combo-moneda').value ="",
                 CURSOS.imgAccount = "";
        },
        previewImage: function(e){
            CURSOS.imgInfo  = document.getElementById("customFile").files[0];
           console.log(CURSOS.imgInfo )
           if( CURSOS.imgInfo.type == "image/jpeg" ||  CURSOS.imgInfo.type == "image/png" ||  CURSOS.imgInfo.type == "image/jpg"){
               let filereader = new FileReader();
               filereader.readAsDataURL(e.target.files[0])
               filereader.onload = (e) => {
                CURSOS.imgAccount = e.target.result
               }
           }else{
            CURSOS.alertMessage("myalert alert-infoDanger","Archivo no valido","fas fa-exclamation bg-infoDanger");
            CURSOS.imgAccount = '../../src/img/noImagen.svg';
           }
        },
        previewImageUpdate: function(e){
            let imgInfo  = document.getElementById("customFile-update").files[0];
            console.log(imgInfo )
            if( imgInfo.type == "image/jpeg" ||  imgInfo.type == "image/png" || imgInfo.type == "image/jpg"){
               let filereader = new FileReader();
               filereader.readAsDataURL(e.target.files[0])
               filereader.onload = (e) => {
                CURSOS.imgAccountUpdate = e.target.result
               }
           }else{
            CURSOS.alertMessage("myalert alert-infoDanger","Archivo no valido","fas fa-exclamation bg-infoDanger");
            CURSOS.imgAccountUpdate = '../../src/img/noImagen.svg';
           }
        },
        validarCamposInsert: function(caja){
            if(caja.nombre == 0 || caja.conocimiento == 0 || caja.requisitos == 0 || caja.descripcion == 0 ||
                caja.categoria == 0 || caja.nivel == 0 || caja.precio == "" || caja.moneda == 0){
                return true;
            }
            return false;
        },
        validarTypeImagen: function(imagen ){
            if(imagen.type == "image/jpeg" ||  imagen.type=="image/png" ||  imagen.type == "image/jpg"){
                return false;
            }
            return true;
        },
        validarImgSelected: function(imgSelected){
            if(imgSelected == ""  ){
                return 'true';
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
    },
    
    });