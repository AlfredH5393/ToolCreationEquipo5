var URL ="../controller/controller_grado_conocimiento.php";
var d = document;
const NIVEL_ESTUDIOS = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Grado de conocimiento',
        conocimientos : [],
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
                    NIVEL_ESTUDIOS.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    NIVEL_ESTUDIOS.paginas = Math.ceil(NIVEL_ESTUDIOS.totalRegistros / NIVEL_ESTUDIOS.itemsPerPage)
                    console.log(NIVEL_ESTUDIOS.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    NIVEL_ESTUDIOS.conocimientos = response.data.gradoConocimiento;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreGrado: d.getElementById("insert-nombreGrado").value,
              };
            console.log(datos)
            if(NIVEL_ESTUDIOS.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
               NIVEL_ESTUDIOS.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = NIVEL_ESTUDIOS.toFormData(datos,'insert');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    NIVEL_ESTUDIOS.cargarDatos();
                    NIVEL_ESTUDIOS.alertMessage("myalert alert-correct","Se ha registrado el NIVEL de ESTUDIOS exitosamente","fas fa-check bg-correct")
                    NIVEL_ESTUDIOS.limpiarCajas();
                    setTimeout(function () {
                        NIVEL_ESTUDIOS.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    NIVEL_ESTUDIOS.alertMessage("myalert alert-fail","El NIVEL de ESTUDIOS no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        NIVEL_ESTUDIOS.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreGrado: d.getElementById("update-nombreGrado").value,
              };
            console.log(datos);
            if(NIVEL_ESTUDIOS.validarCajaUpdate(datos)){
                NIVEL_ESTUDIOS.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = NIVEL_ESTUDIOS.toFormData(datos,'update');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data.msj == "success") {
                    NIVEL_ESTUDIOS.cargarDatos();
                    NIVEL_ESTUDIOS.alertMessage("myalert alert-correct","Se ha actualizado el NIVEL de ESTUDIOS exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        NIVEL_ESTUDIOS.limpiarAlertas();
                    }, 3000);
                } else {
                    NIVEL_ESTUDIOS.alertMessage("myalert alert-fail","El NIVEL de ESTUDIOS no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        NIVEL_ESTUDIOS.limpiarAlertas();
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
            if(NIVEL_ESTUDIOS.validarCajaEliminar(datos)){
                NIVEL_ESTUDIOS.alertMessage("alert alert-infoDanger","Campos vacios");
            }else {
            let formData = NIVEL_ESTUDIOS.toFormData(datos,'delete');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    NIVEL_ESTUDIOS.cargarDatos();
                    NIVEL_ESTUDIOS.alertMessage("myalert alert-correct","Se ha eliminado el NIVEL de ESTUDIOS exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        NIVEL_ESTUDIOS.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    NIVEL_ESTUDIOS.alertMessage("myalert alert-fail","EL NIVEL de ESTUDIOS no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        NIVEL_ESTUDIOS.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreGrado == 0 ){
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
            if(caja.id == 0 || caja.nombreGrado == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(conocimiento){
            d.getElementById("update-id").value = conocimiento.id;
            d.getElementById("update-nombreGrado").value = conocimiento.nombreGrado;
          
        },
        setDatosDelete: function(conocimiento){
            d.getElementById("delete-id").value =  conocimiento.id;
            d.getElementById("delete-nombreGrado").value = conocimiento.nombreGrado;
        },
        alertMessage: function( classe, message, iconName){
            NIVEL_ESTUDIOS.alertgeneral = classe;
            NIVEL_ESTUDIOS.messagealert = message;
            NIVEL_ESTUDIOS.alerticon = iconName;
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
            d.getElementById("insert-nombreGrado").value = "";
          },
        limpiarAlertas: function (){
            NIVEL_ESTUDIOS.alertgeneral = null;
            NIVEL_ESTUDIOS.messagealert = null; 
            NIVEL_ESTUDIOS.alerticon = null;
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
                        NIVEL_ESTUDIOS.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })

        },

    }
});