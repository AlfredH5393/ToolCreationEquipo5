var URL ="../controller/controller_estadotema.php";
var d = document;
const STATE_TEMA = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Estado de temas',
        estadotemas : [],
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
                    STATE_TEMA.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    STATE_TEMA.paginas = Math.ceil(STATE_TEMA.totalRegistros / STATE_TEMA.itemsPerPage)
                    console.log(STATE_TEMA.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    STATE_TEMA.estadotemas = response.data.stateTema;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreEstadoTema: d.getElementById("insert-nombreEstadoTema").value,
              };
            console.log(datos)
            if(STATE_TEMA.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
               STATE_TEMA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_TEMA.toFormData(datos,'insert');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    STATE_TEMA.cargarDatos();
                    STATE_TEMA.alertMessage("myalert alert-correct","Se ha registrado el estado exitosamente","fas fa-check bg-correct")
                    STATE_TEMA.limpiarCajas();
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    STATE_TEMA.alertMessage("myalert alert-fail","El estado no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreEstadoTema: d.getElementById("update-nombreEstadoTema").value,
              };
            console.log(datos);
            if(STATE_TEMA.validarCajaUpdate(datos)){
                STATE_TEMA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_TEMA.toFormData(datos,'update');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data.msj == "success") {
                    STATE_TEMA.cargarDatos();
                    STATE_TEMA.alertMessage("myalert alert-correct","Se ha actualizado el estado exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
                    }, 3000);
                } else {
                    STATE_TEMA.alertMessage("myalert alert-fail","El estado no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
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
            if(STATE_TEMA.validarCajaEliminar(datos)){
                STATE_TEMA.alertMessage("alert alert-infoDanger","Campos vacios");
            }else {
            let formData = STATE_TEMA.toFormData(datos,'delete');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    STATE_TEMA.cargarDatos();
                    STATE_TEMA.alertMessage("myalert alert-correct","Se ha eliminado el estado exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    STATE_TEMA.alertMessage("myalert alert-fail","El estado no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreEstadoTema == 0 ){
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
            if(caja.id == 0 || caja.nombreEstadoTema == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(estado){
            d.getElementById("update-id").value = estado.id;
            d.getElementById("update-nombreEstadoTema").value = estado.nombreEstadoTema;
          
        },
        setDatosDelete: function(estado){
            d.getElementById("delete-id").value =  estado.id;
            d.getElementById("delete-nombreEstadoTema").value = estado.nombreEstadoTema;
        },
        alertMessage: function( classe, message, iconName){
            STATE_TEMA.alertgeneral = classe;
            STATE_TEMA.messagealert = message;
            STATE_TEMA.alerticon = iconName;
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
            d.getElementById("insert-nombreEstadoTema").value = "";
          },
        limpiarAlertas: function (){
            STATE_TEMA.alertgeneral = null;
            STATE_TEMA.messagealert = null; 
            STATE_TEMA.alerticon = null;
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
                        STATE_TEMA.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })

        },

    }
});