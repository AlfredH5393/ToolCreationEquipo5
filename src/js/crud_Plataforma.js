var d = document;
const PLATAFORMA = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Plataforma',
        plataformas : [],
        alertgeneral: null,
        messagealert: null,
        alerticon: null,
        totalRegistros: 0,
        // VARIABLES QUE MUESTRA CUANTOS REGISTROS QUIERE VISUSLIZAR POR PAGINA
        itemsPerPage:2,
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
            axios.post("../controller/controller_plataforma.php", formdata)
                .then(function (response) {
                    // RESPUENTA A LA PETICION
                    console.log(response);
                    PLATAFORMA.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    PLATAFORMA.paginas = Math.ceil(PLATAFORMA.totalRegistros / PLATAFORMA.itemsPerPage)
                    console.log(PLATAFORMA.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post("../controller/controller_plataforma.php", formdata)
                .then(function (response) {
                    console.log(response);
                    PLATAFORMA.plataformas = response.data.plataforma;
                 
                })
        },
        insertar : function(){
            let d = document;
            let datos = {
                nombre: d.getElementById("insert-nombre").value,
                descripcion: d.getElementById("insert-descripcion").value,
                metas: d.getElementById("insert-metas").value,
                objetivos: d.getElementById("insert-objetivos").value,
                mision: d.getElementById("insert-mision").value,
                vision: d.getElementById("insert-vision").value,
              };
            console.log(datos)
            if(PLATAFORMA.validarCajasVacias(datos)){
                PLATAFORMA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = PLATAFORMA.toFormData(datos,'insert');
                axios
                .post("../controller/controller_plataforma.php", formData)
                .then(response => {
                if (response.data) {
                    PLATAFORMA.cargarDatos();
                    PLATAFORMA.alertMessage("myalert alert-correct","Se ha registrado la plataforma exitosamente","fas fa-check bg-correct")
                    PLATAFORMA.limpiarCajas();
                    setTimeout(function () {
                     PLATAFORMA.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    PLATAFORMA.alertMessage("myalert alert-fail","La plataforma no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        PLATAFORMA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let d = document;
            let datos = {
                id: d.getElementById("update-id").value,
                nombre: d.getElementById("update-nombre").value,
                descripcion: d.getElementById("update-descripcion").value,
                metas: d.getElementById("update-metas").value,
                objetivos: d.getElementById("update-objetivos").value,
                mision: d.getElementById("update-mision").value,
                vision: d.getElementById("update-vision").value,
              };
            console.log(datos);
            if(PLATAFORMA.validarCajaUpdate(datos)){
                PLATAFORMA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = PLATAFORMA.toFormData(datos,'update');
                axios
                .post("../controller/controller_plataforma.php", formData)
                .then(response => {
                if (response.data.msj == "success") {
                    PLATAFORMA.cargarDatos();
                    PLATAFORMA.alertMessage("myalert alert-correct","Se ha actualizado la plataforma exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                     PLATAFORMA.limpiarAlertas();
                    }, 3000);
                } else {
                    PLATAFORMA.alertMessage("myalert alert-fail","La plataforma no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        PLATAFORMA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        eliminar: function(){
            let d = document
            let datos = {
                id: d.getElementById("delete-id").value
            }
            console.log(datos)
            if(PLATAFORMA.validarCajaEliminar(datos)){
                PLATAFORMA.alertMessage("alert alert-danger","Campos vacios");
            }else {
            let formData = PLATAFORMA.toFormData(datos,'delete');
                axios
                .post("../controller/controller_plataforma.php", formData)
                .then(response => {
                if (response.data) {
                    PLATAFORMA.cargarDatos();
                    PLATAFORMA.alertMessage("myalert alert-correct","Se ha eliminado la plataforma exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                     PLATAFORMA.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    PLATAFORMA.alertMessage("myalert alert-fail","La plataforma no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        PLATAFORMA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombre == 0 || caja.descripcion == 0 || caja.metas == 0  || caja.objetivos == 0  || caja.mision == 0  || caja.vision == 0){
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
            if(caja.id == 0 || caja.nombre == 0 || caja.descripcion == 0 || caja.metas == 0 || caja.objetivos == 0 || caja.mision == 0 || caja.vision == 0){
                return true;
            }
            return false
        },
        setDatos: function(plataforma){
            let d = document;
            d.getElementById("update-id").value = plataforma.id;
            d.getElementById("update-nombre").value = plataforma.nombrePlataforma;
            d.getElementById("update-descripcion").value = plataforma.descripcionEmpresa;
            d.getElementById("update-metas").value = plataforma.metasPlataforma;
            d.getElementById("update-objetivos").value = plataforma.objetivosPlataforma;
            d.getElementById("update-mision").value = plataforma.misionPlataforma;
            d.getElementById("update-vision").value = plataforma.visionPlataforma;
        },
        setDatosDelete: function(plataforma){
            let d = document;
            d.getElementById("delete-id").value =  plataforma.id;
            d.getElementById("delete-nombre").value = plataforma.nombrePlataforma;
        },
        alertMessage: function( classe, message, iconName){
            PLATAFORMA.alertgeneral = classe;
            PLATAFORMA.messagealert = message;
            PLATAFORMA.alerticon = iconName;
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
            d.getElementById("insert-nombre").value = "";
            d.getElementById("insert-descripcion").value = "";
            d.getElementById("insert-metas").value = "";
            d.getElementById("insert-objetivos").value = "";
            d.getElementById("insert-mision").value = "";
            d.getElementById("insert-vision").value = "";
          },
        limpiarAlertas: function (){
           PLATAFORMA.alertgeneral = null;
           PLATAFORMA.messagealert = null; 
           PLATAFORMA. alerticon = null;
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
                        PLATAFORMA.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })
        },
    }

});