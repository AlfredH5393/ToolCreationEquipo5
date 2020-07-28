var URL ="../controller/controller_tipovideo.php";
var d = document;
const TIPO_VIDEO = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Tipo de Videos',
        typeVideo : [],
        alertgeneral: null,
        messagealert: null,
        alerticon: null,
        totalRegistros: 0,
        // VARIABLES QUE MUESTRA CUANTOS REGISTROS QUIERE VISUSLIZAR POR PAGINA
        itemsPerPage:5,
        paginas: 1,
        paginaActual: 1,
        siguiente: '',
        anterior: '',
        ocultarMostrarSiguiente: '',
        ocultarMostrarAnterior:  ''  
    },
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
                    TIPO_VIDEO.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    TIPO_VIDEO.paginas = Math.ceil(TIPO_VIDEO.totalRegistros / TIPO_VIDEO.itemsPerPage)
                    console.log(TIPO_VIDEO.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    TIPO_VIDEO.typeVideo = response.data.tipoVideo;
                })
        },
        insertar : function(){
            let datos = {
                nombreTipoVid: d.getElementById("insert-nombreTipoVid").value,
              };
            console.log(datos)
            if(TIPO_VIDEO.validarCajasVacias(datos)){
                TIPO_VIDEO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_VIDEO.toFormData(datos,'insert');
                axios
                .post( URL, formData)
                .then(response => {
                if (response.data) {
                    TIPO_VIDEO.cargarDatos();
                    TIPO_VIDEO.alertMessage("myalert alert-correct","Se ha registrado el tipo de video "+ datos.nombreTipoVid + " exitosamente","fas fa-check bg-correct")
                    TIPO_VIDEO.limpiarCajas();
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                     TIPO_VIDEO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_VIDEO.alertMessage("myalert alert-fail","EL tipo de video"+ datos.nombreTipoVid +" no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_VIDEO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreTipoVid: d.getElementById("update-nombreTipoVid").value,
              };
            console.log(datos);
            if(TIPO_VIDEO.validarCajaUpdate(datos)){
                TIPO_VIDEO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_VIDEO.toFormData(datos,'update');
                axios
                .post( URL , formData)
                .then(response => {
                if (response.data.msj == "success") {
                    TIPO_VIDEO.cargarDatos();
                    TIPO_VIDEO.alertMessage("myalert alert-correct","Se ha actualizado el el tipo de video "+ datos.nombreTipoVid +" exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        TIPO_VIDEO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_VIDEO.alertMessage("myalert alert-fail","El tipo de vidfeo "+ datos.nombreTipoVid +" no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_VIDEO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        eliminar: function(){
            let datos = {
                id: d.getElementById("delete-id").value,
                nombreTipoVid : d.getElementById("delete-nombreTipoVid").value
            }
            console.log(datos)
            if(TIPO_VIDEO.validarCajaEliminar(datos)){
                TIPO_VIDEO.alertMessage("myalert alert-infoDanger","Campos vacios", "fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_VIDEO.toFormData(datos,'delete');
                axios
                .post( URL , formData)
                .then(response => {
                if (response.data) {
                    TIPO_VIDEO.cargarDatos();
                    TIPO_VIDEO.alertMessage("myalert alert-correct","Se ha eliminado el tipo de video "+ datos.nombreTipoVid +" exitosamente","fas fa-check bg-correct")
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                        TIPO_VIDEO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_VIDEO.alertMessage("myalert alert-fail","El tipo de video "+ datos.nombreTipoVid +" no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_VIDEO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreTipoVid == 0){
                return true;
            }
            return false
        },
        validarCajaEliminar:function(caja){
            if(caja.id == 0 || caja.nombreTipoVid == 0) {
                return true;
            }
            return false
        },
        validarCajaUpdate: function(caja){
            if(caja.id == 0 || caja.nombreTipoVid == 0){
                return true;
            }
            return false
        },
        setDatos: function(recursos){
            d.getElementById("update-id").value = recursos.id;
            d.getElementById("update-nombreTipoVid").value = recursos.nombreTipoVideo;
            
        },
        setDatosDelete: function(recursos){
            d.getElementById("delete-id").value =  recursos.id;
            d.getElementById("delete-nombreTipoVid").value = recursos.nombreTipoVideo;
        },
        alertMessage: function( classe, message, iconName){
            TIPO_VIDEO.alertgeneral = classe;
            TIPO_VIDEO.messagealert = message;
            TIPO_VIDEO.alerticon = iconName;
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
            d.getElementById("insert-nombreTipoVid").value = "";
          },
        limpiarAlertas: function (){
           TIPO_VIDEO.alertgeneral = null;
           TIPO_VIDEO.messagealert = null; 
           TIPO_VIDEO.alerticon = null;
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
                        TIPO_VIDEO.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })
 
        },
        
    }
});