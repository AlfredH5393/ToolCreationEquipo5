var URL ="../controller/controller_tiporecurso.php";
var d = document;
const TIPO_RECURSO = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Tipo de Recursos',
        typeRecursos : [],
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
                    TIPO_RECURSO.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    TIPO_RECURSO.paginas = Math.ceil(TIPO_RECURSO.totalRegistros / TIPO_RECURSO.itemsPerPage)
                    console.log(TIPO_RECURSO.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    TIPO_RECURSO.typeRecursos = response.data.tipoRec;
                })
        },
        insertar : function(){
            let datos = {
                nombreTipoRec: d.getElementById("insert-nombreTipoRec").value,
              };
            console.log(datos)
            if(TIPO_RECURSO.validarCajasVacias(datos)){
                TIPO_RECURSO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_RECURSO.toFormData(datos,'insert');
                axios
                .post( URL, formData)
                .then(response => {
                if (response.data) {
                    TIPO_RECURSO.cargarDatos();
                    TIPO_RECURSO.alertMessage("myalert alert-correct","Se ha registrado el tipo de recurso "+ datos.nombreTipoRec + " exitosamente","fas fa-check bg-correct")
                    TIPO_RECURSO.limpiarCajas();
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                     TIPO_RECURSO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_RECURSO.alertMessage("myalert alert-fail","EL tipo de recurso"+ datos.nombreTipoRec +" no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_RECURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreTipoRec: d.getElementById("update-nombreTipoRec").value,
              };
            console.log(datos);
            if(TIPO_RECURSO.validarCajaUpdate(datos)){
                TIPO_RECURSO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_RECURSO.toFormData(datos,'update');
                axios
                .post( URL , formData)
                .then(response => {
                if (response.data.msj == "success") {
                    TIPO_RECURSO.cargarDatos();
                    TIPO_RECURSO.alertMessage("myalert alert-correct","Se ha actualizado el el tipo de recurso "+ datos.nombreTipoRec +" exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        TIPO_RECURSO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_RECURSO.alertMessage("myalert alert-fail","El tipo de recurso "+ datos.nombreTipoRec +" no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_RECURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        eliminar: function(){
            let datos = {
                id: d.getElementById("delete-id").value,
                nombreTipoRec : d.getElementById("delete-nombreTipoRec").value
            }
            console.log(datos)
            if(TIPO_RECURSO.validarCajaEliminar(datos)){
                TIPO_RECURSO.alertMessage("myalert alert-infoDanger","Campos vacios", "fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_RECURSO.toFormData(datos,'delete');
                axios
                .post( URL , formData)
                .then(response => {
                if (response.data) {
                    TIPO_RECURSO.cargarDatos();
                    TIPO_RECURSO.alertMessage("myalert alert-correct","Se ha eliminado el tipo de recurso "+ datos.nombreTipoRec +" exitosamente","fas fa-check bg-correct")
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                        TIPO_RECURSO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_RECURSO.alertMessage("myalert alert-fail","El tipo de recurso "+ datos.nombreTipoRec +" no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_RECURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreTipoRec == 0){
                return true;
            }
            return false
        },
        validarCajaEliminar:function(caja){
            if(caja.id == 0 || caja.nombreTipoRec == 0) {
                return true;
            }
            return false
        },
        validarCajaUpdate: function(caja){
            if(caja.id == 0 || caja.nombreTipoRec == 0){
                return true;
            }
            return false
        },
        setDatos: function(recursos){
            d.getElementById("update-id").value = recursos.id;
            d.getElementById("update-nombreTipoRec").value = recursos.nombreTipoRec;
            
        },
        setDatosDelete: function(recursos){
            d.getElementById("delete-id").value =  recursos.id;
            d.getElementById("delete-nombreTipoRec").value = recursos.nombreTipoRec;
        },
        alertMessage: function( classe, message, iconName){
            TIPO_RECURSO.alertgeneral = classe;
            TIPO_RECURSO.messagealert = message;
            TIPO_RECURSO.alerticon = iconName;
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
            d.getElementById("insert-nombrePromo").value = "";
          },
        limpiarAlertas: function (){
           TIPO_RECURSO.alertgeneral = null;
           TIPO_RECURSO.messagealert = null; 
           TIPO_RECURSO.alerticon = null;
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
        },closeSesion: () =>{
            let formdata = new FormData();
            formdata.append('option','destroySesion');
            axios.post("../controller/controller_login.php", formdata)
                    .then(function (response) {
                        console.log(response);
                    if(response.data == "1"){
                        window.location.href = "../public/login.html";
                    }else{
                        TIPO_RECURSO.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })
 
        },
    }
});