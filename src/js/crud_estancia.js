var URL ="../controller/controller_estancia.php";
var d = document;
const ESTANCIA = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Universidades',
        estancias : [],
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
                    ESTANCIA.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    ESTANCIA.paginas = Math.ceil(ESTANCIA.totalRegistros / ESTANCIA.itemsPerPage)
                    console.log(ESTANCIA.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    ESTANCIA.estancias = response.data.estancia;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreEstancia: d.getElementById("insert-nombreEstancia").value,
              };
            console.log(datos)
            if(ESTANCIA.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
               ESTANCIA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = ESTANCIA.toFormData(datos,'insert');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    ESTANCIA.cargarDatos();
                    ESTANCIA.alertMessage("myalert alert-correct","Se ha registrado la estancia exitosamente","fas fa-check bg-correct")
                    ESTANCIA.limpiarCajas();
                    setTimeout(function () {
                        ESTANCIA.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    ESTANCIA.alertMessage("myalert alert-fail","La estancia no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        ESTANCIA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreEstancia: d.getElementById("update-nombreEstancia").value,
              };
            console.log(datos);
            if(ESTANCIA.validarCajaUpdate(datos)){
                ESTANCIA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = ESTANCIA.toFormData(datos,'update');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data.msj == "success") {
                    ESTANCIA.cargarDatos();
                    ESTANCIA.alertMessage("myalert alert-correct","Se ha actualizado la estancia exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        ESTANCIA.limpiarAlertas();
                    }, 3000);
                } else {
                    ESTANCIA.alertMessage("myalert alert-fail","La estancia no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        ESTANCIA.limpiarAlertas();
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
            if(ESTANCIA.validarCajaEliminar(datos)){
                ESTANCIA.alertMessage("alert alert-infoDanger","Campos vacios");
            }else {
            let formData = ESTANCIA.toFormData(datos,'delete');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    ESTANCIA.cargarDatos();
                    ESTANCIA.alertMessage("myalert alert-correct","Se ha eliminado la estancia exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        ESTANCIA.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    ESTANCIA.alertMessage("myalert alert-fail","La estancia no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        ESTANCIA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreEstancia == 0 ){
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
            if(caja.id == 0 || caja.nombreEstancia == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(estado){
            d.getElementById("update-id").value = estado.id;
            d.getElementById("update-nombreEstancia").value = estado.nombreEstancia;
          
        },
        setDatosDelete: function(estado){
            d.getElementById("delete-id").value =  estado.id;
            d.getElementById("delete-nombreEstancia").value = estado.nombreEstancia;
        },
        alertMessage: function( classe, message, iconName){
            ESTANCIA.alertgeneral = classe;
            ESTANCIA.messagealert = message;
            ESTANCIA.alerticon = iconName;
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
            d.getElementById("insert-nombreEstancia").value = "";
          },
        limpiarAlertas: function (){
            ESTANCIA.alertgeneral = null;
            ESTANCIA.messagealert = null; 
            ESTANCIA.alerticon = null;
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
                        ESTANCIA.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })

        },

    }
});