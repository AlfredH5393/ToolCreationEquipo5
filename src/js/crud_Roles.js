var URL ="../controller/controller_roles.php";
var d = document;
const ROLES = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'ROLES',
        roles : [],
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
            axios.post("../controller/controller_roles.php", formdata)
                .then(function (response) {
                    // RESPUENTA A LA PETICION
                    console.log(response);
                    ROLES.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    ROLES.paginas = Math.ceil(ROLES.totalRegistros / ROLES.itemsPerPage)
                    console.log(ROLES.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post("../controller/controller_roles.php", formdata)
                .then(function (response) {
                    console.log(response);
                    ROLES.roles = response.data.rol;
                })
        },
        insertar : function(){
            let datos = {
                nombreRol: d.getElementById("insert-nombreRol").value,
              };
            console.log(datos)
            if(ROLES.validarCajasVacias(datos)){
                ROLES.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = ROLES.toFormData(datos,'insert');
                axios
                .post("../controller/controller_roles.php", formData)
                .then(response => {
                if (response.data) {
                    ROLES.cargarDatos();
                    ROLES.alertMessage("myalert alert-correct","Se ha registrado el rol  "+ datos.nombreRol + " exitosamente","fas fa-check bg-correct")
                    ROLES.limpiarCajas();
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                     ROLES.limpiarAlertas();
                    }, 3000);
                } else {
                    ROLES.alertMessage("myalert alert-fail","EL ROL"+ datos.nombreRol +" no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        ROLES.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreRol: d.getElementById("update-nombreRol").value,
              };
            console.log(datos);
            if(ROLES.validarCajaUpdate(datos)){
                ROLES.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = ROLES.toFormData(datos,'update');
                axios
                .post("../controller/controller_roles.php", formData)
                .then(response => {
                if (response.data.msj == "success") {
                    ROLES.cargarDatos();
                    ROLES.alertMessage("myalert alert-correct","Se ha actualizado el rol "+ datos.nombreRol +" exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                     ROLES.limpiarAlertas();
                    }, 3000);
                } else {
                    ROLES.alertMessage("myalert alert-fail","El rol "+ datos.nombreRol +" no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        ROLES.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        eliminar: function(){
            let datos = {
                id: d.getElementById("delete-id").value,
                nombreRol : d.getElementById("delete-nombreRol").value
            }
            console.log(datos)
            if(ROLES.validarCajaEliminar(datos)){
                ROLES.alertMessage("myalert alert-infoDanger","Campos vacios", "fas fa-exclamation bg-infoDanger");
            }else {
            let formData = ROLES.toFormData(datos,'delete');
                axios
                .post("../controller/controller_roles.php", formData)
                .then(response => {
                if (response.data) {
                    ROLES.cargarDatos();
                    ROLES.alertMessage("myalert alert-correct","Se ha eliminado el rol "+ datos.nombreRol +" exitosamente","fas fa-check bg-correct")
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                    setTimeout(function () {
                     ROLES.limpiarAlertas();
                    }, 3000);
                } else {
                    ROLES.alertMessage("myalert alert-fail","El rol "+ datos.nombreRol +" no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        ROLES.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreRol == 0){
                return true;
            }
            return false
        },
        validarCajaEliminar:function(caja){
            if(caja.id == 0 || caja.nombreRol == 0) {
                return true;
            }
            return false
        },
        validarCajaUpdate: function(caja){
            if(caja.id == 0 || caja.nombreRol == 0){
                return true;
            }
            return false
        },
        setDatos: function(rol){
            d.getElementById("update-id").value = rol.id;
            d.getElementById("update-nombreRol").value = rol.nombreRol;
            
        },
        setDatosDelete: function(rol){
            d.getElementById("delete-id").value =  rol.id;
            d.getElementById("delete-nombreRol").value = rol.nombreRol;
        },
        alertMessage: function( classe, message, iconName){
            ROLES.alertgeneral = classe;
            ROLES.messagealert = message;
            ROLES.alerticon = iconName;
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
            d.getElementById("insert-nombreRol").value = "";
          },
        limpiarAlertas: function (){
           ROLES.alertgeneral = null;
           ROLES.messagealert = null; 
           ROLES.alerticon = null;
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
                    ROLES.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                   }
                    
           })

       },
    }
});