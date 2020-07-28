var URL ="../controller/controller_estadousuario.php";
var d = document;
const STATE_USER = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Estado de usuarios',
        estadousuarios : [],
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
                    STATE_USER.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    STATE_USER.paginas = Math.ceil(STATE_USER.totalRegistros / STATE_USER.itemsPerPage)
                    console.log(STATE_USER.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    STATE_USER.estadousuarios = response.data.stateUser;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreEstadoUsuario: d.getElementById("insert-nombreEstadoUsuario").value,
                descripcion : d.getElementById("insert-desc").value
              };
            console.log(datos)
            if(STATE_USER.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
               STATE_USER.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_USER.toFormData(datos,'insert');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    STATE_USER.cargarDatos();
                    STATE_USER.alertMessage("myalert alert-correct","Se ha registrado el estado exitosamente","fas fa-check bg-correct")
                    STATE_USER.limpiarCajas();
                    setTimeout(function () {
                        STATE_USER.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    STATE_USER.alertMessage("myalert alert-fail","El estado no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_USER.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreEstadoUsuario: d.getElementById("update-nombreEstadoUsuario").value,
                descripcion : d.getElementById("update-desc").value
              };
            console.log(datos);
            if(STATE_USER.validarCajaUpdate(datos)){
                STATE_USER.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_USER.toFormData(datos,'update');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data.msj == "success") {
                    STATE_USER.cargarDatos();
                    STATE_USER.alertMessage("myalert alert-correct","Se ha actualizado el estado exitosamente " + response.data,"fas fa-check bg-correct")
                    setTimeout(function () {
                        STATE_USER.limpiarAlertas();
                    }, 3000);
                } else {
                    STATE_USER.alertMessage("myalert alert-fail","El estado no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_USER.limpiarAlertas();
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
            if(STATE_USER.validarCajaEliminar(datos)){
                STATE_USER.alertMessage("alert alert-infoDanger","Campos vacios");
            }else {
            let formData = STATE_USER.toFormData(datos,'delete');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    STATE_USER.cargarDatos();
                    STATE_USER.alertMessage("myalert alert-correct","Se ha eliminado el estado exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        STATE_USER.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    STATE_USER.alertMessage("myalert alert-fail","El estado no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_USER.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreEstadoUsuario == 0 || caja.descripcion == 0 ){
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
            if(caja.id == 0 || caja.nombreEstadoUsuario == 0  || caja.descripcion == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(estado){
            d.getElementById("update-id").value = estado.id;
            d.getElementById("update-nombreEstadoUsuario").value = estado.nombreEstado;
            d.getElementById("update-desc").value = estado.descripcion;

          
        },
        setDatosDelete: function(estado){
            d.getElementById("delete-id").value =  estado.id;
            d.getElementById("delete-nombreEstadoUsuario").value = estado.nombreEstado;


        },
        alertMessage: function( classe, message, iconName){
            STATE_USER.alertgeneral = classe;
            STATE_USER.messagealert = message;
            STATE_USER.alerticon = iconName;
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
            d.getElementById("insert-nombreEstadoUsuario").value = "";
            d.getElementById("insert-desc").value = "";
          },
        limpiarAlertas: function (){
            STATE_USER.alertgeneral = null;
            STATE_USER.messagealert = null; 
            STATE_USER.alerticon = null;
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
                        STATE_USER.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })

        },
        

    }
});