var URL ="../controller/controller_tipo_promo.php";
var d = document;
const TIPO_PROMO = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Tipo de promociones',
        registros : [],
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
                    TIPO_PROMO.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    TIPO_PROMO.paginas = Math.ceil(TIPO_PROMO.totalRegistros / TIPO_PROMO.itemsPerPage)
                    console.log(TIPO_PROMO.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    TIPO_PROMO.registros = response.data.tipo;
                })
        },
        insertar : function(){
            let datos = {
                nombreTipoPromo: d.getElementById("insert-nombrePromo").value,
              };
            console.log(datos)
            if(TIPO_PROMO.validarCajasVacias(datos)){
                TIPO_PROMO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_PROMO.toFormData(datos,'insert');
                axios
                .post( URL, formData)
                .then(response => {
                if (response.data) {
                    TIPO_PROMO.cargarDatos();
                    TIPO_PROMO.alertMessage("myalert alert-correct","Se ha registrado el tipo de promocion "+ datos.nombreTipoPromo + " exitosamente","fas fa-check bg-correct")
                    TIPO_PROMO.limpiarCajas();
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                     TIPO_PROMO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_PROMO.alertMessage("myalert alert-fail","EL tipo de promocion"+ datos.nombreTipoPromo +" no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_PROMO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreTipoPromo: d.getElementById("update-nombrePromo").value,
              };
            console.log(datos);
            if(TIPO_PROMO.validarCajaUpdate(datos)){
                TIPO_PROMO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_PROMO.toFormData(datos,'update');
                axios
                .post( URL , formData)
                .then(response => {
                if (response.data.msj == "success") {
                    TIPO_PROMO.cargarDatos();
                    TIPO_PROMO.alertMessage("myalert alert-correct","Se ha actualizado el el tipo de promocion "+ datos.nombreTipoPromo +" exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        TIPO_PROMO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_PROMO.alertMessage("myalert alert-fail","El tipo de promocion "+ datos.nombreTipoPromo +" no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_PROMO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        eliminar: function(){
            let datos = {
                id: d.getElementById("delete-id").value,
                nombreTipoPromo : d.getElementById("delete-nombrePromo").value
            }
            console.log(datos)
            if(TIPO_PROMO.validarCajaEliminar(datos)){
                TIPO_PROMO.alertMessage("myalert alert-infoDanger","Campos vacios", "fas fa-exclamation bg-infoDanger");
            }else {
            let formData = TIPO_PROMO.toFormData(datos,'delete');
                axios
                .post( URL , formData)
                .then(response => {
                if (response.data) {
                    TIPO_PROMO.cargarDatos();
                    TIPO_PROMO.alertMessage("myalert alert-correct","Se ha eliminado el tipo de promocion "+ datos.nombreTipoPromo +" exitosamente","fas fa-check bg-correct")
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                        TIPO_PROMO.limpiarAlertas();
                    }, 3000);
                } else {
                    TIPO_PROMO.alertMessage("myalert alert-fail","El tipo de promocion "+ datos.nombreTipoPromo +" no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        TIPO_PROMO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreTipoPromo == 0){
                return true;
            }
            return false
        },
        validarCajaEliminar:function(caja){
            if(caja.id == 0 || caja.nombreTipoPromo == 0) {
                return true;
            }
            return false
        },
        validarCajaUpdate: function(caja){
            if(caja.id == 0 || caja.nombreTipoPromo == 0){
                return true;
            }
            return false
        },
        setDatos: function(rol){
            d.getElementById("update-id").value = rol.id;
            d.getElementById("update-nombrePromo").value = rol.nombreTipoPromo;
            
        },
        setDatosDelete: function(rol){
            d.getElementById("delete-id").value =  rol.id;
            d.getElementById("delete-nombrePromo").value = rol.nombreTipoPromo;
        },
        alertMessage: function( classe, message, iconName){
            TIPO_PROMO.alertgeneral = classe;
            TIPO_PROMO.messagealert = message;
            TIPO_PROMO.alerticon = iconName;
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
           TIPO_PROMO.alertgeneral = null;
           TIPO_PROMO.messagealert = null; 
           TIPO_PROMO.alerticon = null;
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
                    TIPO_PROMO.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                   }
                    
           })

       },
    }
});