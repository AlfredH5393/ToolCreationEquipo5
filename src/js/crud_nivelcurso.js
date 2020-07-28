var URL ="../controller/controller_nivel.php";
var d = document;
const NIVEL_CURSO = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Nivel de Curso',
        nivelcursos : [],
        alertgeneral: null,
        messagealert: null,
        alerticon: null,
        totalRegistros: 0,
        itemsPerPage:5,
        paginas: 1,
        paginaActual: 1,
        siguiente: '',
        anterior: '',
        ocultarMostrarSiguiente: '',
        ocultarMostrarAnterior:  ''  
     },
     //CICLO DE  VIDA
    mounted: function() {
        this.cargarDatos();
        this.cargarTotalRegistros();
        this.paginar(1);

    },
    methods: {
        cargarTotalRegistros: function(){
            //FORMDATA ES UNA FUNCION QUE TE PERMITE ENVIAR PARAMETROS A PHP
            let formdata = new FormData();
            //APPEND ES DONDE AGREGAR EL NOMBRE Y VALOR
            formdata.append("option", "count")
           
            //AXIOS TE PERMITE HACER UNA PETICION AL SERVIDOR O BD DE FORMA ASYCRONA
            axios.post(URL, formdata)
                .then(function (response) {
                    // RESPUENTA A LA PETICION
                    console.log(response);
                    NIVEL_CURSO.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    NIVEL_CURSO.paginas = Math.ceil(NIVEL_CURSO.totalRegistros / NIVEL_CURSO.itemsPerPage)
                    console.log(NIVEL_CURSO.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    NIVEL_CURSO.nivelcursos = response.data.estadoNivel;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreNivel: d.getElementById("insert-nombreNivel").value,
              };
            console.log(datos)
            if(NIVEL_CURSO.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
               NIVEL_CURSO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = NIVEL_CURSO.toFormData(datos,'insert');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    NIVEL_CURSO.cargarDatos();
                    NIVEL_CURSO.alertMessage("myalert alert-correct","Se ha registrado el NIVEL deL CURSO exitosamente","fas fa-check bg-correct")
                    NIVEL_CURSO.limpiarCajas();
                    setTimeout(function () {
                        NIVEL_CURSO.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    NIVEL_CURSO.alertMessage("myalert alert-fail","El NIVEL del CURSO  no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        NIVEL_CURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreNivel: d.getElementById("update-nombreNivel").value,
              };
            console.log(datos);
            if(NIVEL_CURSO.validarCajaUpdate(datos)){
                NIVEL_CURSO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = NIVEL_CURSO.toFormData(datos,'update');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data.msj == "success") {
                    NIVEL_CURSO.cargarDatos();
                    NIVEL_CURSO.alertMessage("myalert alert-correct","Se ha actualizado El NIVEL del CURSO exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        NIVEL_CURSO.limpiarAlertas();
                    }, 3000);
                } else {
                    NIVEL_CURSO.alertMessage("myalert alert-fail","El NIVEL del CURSO no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        NIVEL_CURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        eliminar: function(){
            let datos = {
                id: d.getElementById("delete-id").value
            }
            console.log(datos)
            if(NIVEL_CURSO.validarCajaEliminar(datos)){
                NIVEL_CURSO.alertMessage("alert alert-infoDanger","Campos vacios");
            }else {
            let formData = NIVEL_CURSO.toFormData(datos,'delete');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    NIVEL_CURSO.cargarDatos();
                    NIVEL_CURSO.alertMessage("myalert alert-correct","Se ha eliminado El NIVEL del CURSO exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        NIVEL_CURSO.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    NIVEL_CURSO.alertMessage("myalert alert-fail","El NIVEL del CURSO no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        NIVEL_CURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreNivel == 0 ){
                return true;
            }
            return false
        },
        validarCajaEliminar:function(caja){
            if(caja.id == 0) {
                return true;
            }
            return false
        },
        validarCajaUpdate: function(caja){
            if(caja.id == 0 || caja.nombreNivel == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(nivel){
            d.getElementById("update-id").value = nivel.id;
            d.getElementById("update-nombreNivel").value = nivel.nombreNivel;
          
        },
        setDatosDelete: function(nivel){
            d.getElementById("delete-id").value =  nivel.id;
            d.getElementById("delete-nombreNivel").value = nivel.nombreNivel;
        },
        alertMessage: function( classe, message, iconName){
            NIVEL_CURSO.alertgeneral = classe;
            NIVEL_CURSO.messagealert = message;
            NIVEL_CURSO.alerticon = iconName;
        },
        toFormData: (obj, option) => {
            let fd = new FormData();
            fd.append('option', option);
              for (let i in obj) {
                fd.append(i, obj[i]);
              }
            return fd;
        },
        limpiarCajas: function(){
            d.getElementById("insert-nombreNivel").value = "";
          },
        limpiarAlertas: function (){
            NIVEL_CURSO.alertgeneral = null;
            NIVEL_CURSO.messagealert = null; 
            NIVEL_CURSO.alerticon = null;
        },
        //metodos para paginar
        paginar: function(pagina){
            this.paginaActual = pagina;
            this.anterior = (( this.paginaActual -1) * this.itemsPerPage);
            this.siguiente = this.paginaActual * this.itemsPerPage;

            this.paginaActual == 1 ? this.ocultarMostrarAnterior = "page-item disabled" : this.ocultarMostrarAnterior = "page-item";
            this.paginaActual == this.paginas ? this.ocultarMostrarSiguiente = "page-item disabled" : this.ocultarMostrarSiguiente = "page-item";
        },
        prev:function (){
            this.paginaActual =  this.paginaActual - 1;
            
            this.paginar(this.paginaActual);
        },
        next: function(){
            this.paginaActual = this.paginaActual + 1;
            this.paginar(this.paginaActual);
        },
        closeSesion: () =>{
           let formdata = new FormData();
           formdata.append('option','destroySesion');
           axios.post("../controller/controller_login.php", formdata)
                   .then(function (response) {
                       console.log(response);
                   if(response.data == "1"){
                       window.location.href = "../public/login.html";
                   }else{
                    NIVEL_CURSO.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                   }
                    
           })

       },

    }
});