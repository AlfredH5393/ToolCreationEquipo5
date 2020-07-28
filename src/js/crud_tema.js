const ENDPOINT_TEMAS = "../../controller/controller_tema.php";
const ENDPOINT_LOG_PROFESOR = "../../controller/controller_login.php";
var d = document;
const STATE_TEMA = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Temas',
        listaTemas : [],
        alertgeneral: null,
        messagealert: null,
        alerticon: null,
        displayAlert: "display:none",
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
     
            let formdata = new FormData();
            //APPEND ES DONDE AGREGAR EL NOMBRE Y VALOR
            formdata.append("option", "count")
            formdata.append("IDCURSO", d.getElementById("idCurso").value)
            //AXIOS TE PERMITE HACER UNA PETICION AL SERVIDOR O BD DE FORMA ASYCRONA
            axios.post(ENDPOINT_TEMAS, formdata)
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
            formdata.append("IDCURSO", d.getElementById("idCurso").value)
            axios.post(ENDPOINT_TEMAS, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    STATE_TEMA.listaTemas = response.data.temas;
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreTema: d.getElementById("insert-nombre").value,
                descripcion: d.getElementById("insert-descripcion").value,
                IDCURSO:  d.getElementById("idCurso").value
              };
            if(STATE_TEMA.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
               STATE_TEMA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_TEMA.toFormData(datos,'insert');
                axios
                .post(ENDPOINT_TEMAS, formData)
                .then(response => {
                if (response.data) {
                    STATE_TEMA.cargarDatos();
                    STATE_TEMA.alertMessage("myalert alert-correct","Se ha registrado el tema exitosamente","fas fa-check bg-correct")
                    STATE_TEMA.limpiarCajas();
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    STATE_TEMA.alertMessage("myalert alert-fail","El tema no pudo registrarce" + response.data, "fas fa-times bg-fail");
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
                nombreTema: d.getElementById("update-nombre").value,
                descripcion: d.getElementById("update-descripcion").value,
              };
            console.log(datos);
            if(STATE_TEMA.validarCajaUpdate(datos)){
                STATE_TEMA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_TEMA.toFormData(datos,'update');
                axios
                .post(ENDPOINT_TEMAS, formData)
                .then(response => {
                console.log( response.data)
                if (response.data =="") {
                    STATE_TEMA.cargarDatos();
                    STATE_TEMA.alertMessage("myalert alert-correct","Se ha actualizado el tema exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        STATE_TEMA.limpiarAlertas();
                    }, 3000);
                } else {
                    STATE_TEMA.alertMessage("myalert alert-fail","El tema no pudo actulizarce" + response.data, "fas fa-times bg-fail");
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
                .post(ENDPOINT_TEMAS, formData)
                .then(response => {
                if (response.data == "") {
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
            if( caja.nombreTema == 0 || caja.IDCURSO == 0 ){
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
            if(caja.id == 0 || caja.nombreTema == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(tema){
            d.getElementById("update-id").value = tema.id;
            d.getElementById("update-nombre").value = tema.nombre;
            d.getElementById("update-descripcion").value = tema.descripcion;
          
        },
        setDatosDelete: function(tema){
            d.getElementById("delete-id").value =  tema.id;
            d.getElementById("delete-nombre").value = tema.nombre;
        },
        alertMessage: function( classe, message, iconName){
            STATE_TEMA.alertgeneral = classe;
            STATE_TEMA.messagealert = message;
            STATE_TEMA.alerticon = iconName;
            STATE_TEMA.displayAlert ="";
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
            d.getElementById("insert-nombre").value = ""
            d.getElementById("insert-descripcion").value = ""
          },
        limpiarAlertas: function (){
            STATE_TEMA.alertgeneral = null;
            STATE_TEMA.messagealert = null; 
            STATE_TEMA.alerticon = null;
            STATE_TEMA.displayAlert = "display:none";
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
        closeSesionRol: () => {
            let formdata = new FormData();
                formdata.append('option','destroySesion');
                    axios.post(ENDPOINT_LOG_PROFESOR, formdata)
                         .then(function (response) {
                            console.log(response);
                                if(response.data == "1"){
                                    window.location.href = "../../public/login.html";
                                }else{
                                    CLOSE.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                                }
                    })               
        },

    }
});