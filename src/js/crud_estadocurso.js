var URL ="../controller/controller_estadocurso.php";
var d = document;
const STATE_CURSO = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Estado de cursos',
        estadocursos : [],
        alertgeneral: null,
        messagealert: null,
        alerticon: null,

        // Variables para la paginacion [NOTA: NO TOCAR]
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
     //CICLO DE  VIDA
    mounted: function() {
        this.cargarDatos();
        //METODO SIRVE PARA OBTENER EL TOTAL DE REGISTROS
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
                    STATE_CURSO.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    STATE_CURSO.paginas = Math.ceil(STATE_CURSO.totalRegistros / STATE_CURSO.itemsPerPage)
                    console.log("le asigne "+STATE_CURSO.paginas + "A PAGINAS");
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    STATE_CURSO.estadocursos = response.data.estadoCurso;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreEstadoCurso: d.getElementById("insert-nombreEstadoCurso").value,
              };
            console.log(datos)
            if(STATE_CURSO.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
               STATE_CURSO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_CURSO.toFormData(datos,'insert');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    STATE_CURSO.cargarDatos();
                    STATE_CURSO.alertMessage("myalert alert-correct","Se ha registrado el estado exitosamente","fas fa-check bg-correct")
                    STATE_CURSO.limpiarCajas();
                    setTimeout(function () {
                        STATE_CURSO.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    STATE_CURSO.alertMessage("myalert alert-fail","El estado no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_CURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreEstadoCurso: d.getElementById("update-nombreEstadoCurso").value,
              };
            console.log(datos);
            if(STATE_CURSO.validarCajaUpdate(datos)){
                STATE_CURSO.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = STATE_CURSO.toFormData(datos,'update');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data.msj == "success") {
                    STATE_CURSO.cargarDatos();
                    STATE_CURSO.alertMessage("myalert alert-correct","Se ha actualizado el estado exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        STATE_CURSO.limpiarAlertas();
                    }, 3000);
                } else {
                    STATE_CURSO.alertMessage("myalert alert-fail","El estado no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_CURSO.limpiarAlertas();
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
            if(STATE_CURSO.validarCajaEliminar(datos)){
                STATE_CURSO.alertMessage("alert alert-infoDanger","Campos vacios");
            }else {
            let formData = STATE_CURSO.toFormData(datos,'delete');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    STATE_CURSO.cargarDatos();
                    STATE_CURSO.alertMessage("myalert alert-correct","Se ha eliminado el estado exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        STATE_CURSO.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    STATE_CURSO.alertMessage("myalert alert-fail","El estado no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        STATE_CURSO.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreEstadoCurso == 0 ){
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
            if(caja.id == 0 || caja.nombreEstadoCurso == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(estado){
            d.getElementById("update-id").value = estado.id;
            d.getElementById("update-nombreEstadoCurso").value = estado.nombreEstadoCurso;
          
        },
        setDatosDelete: function(estado){
            d.getElementById("delete-id").value =  estado.id;
            d.getElementById("delete-nombreEstadoCurso").value = estado.nombreEstadoCurso;
        },
        alertMessage: function( classe, message, iconName){
            STATE_CURSO.alertgeneral = classe;
            STATE_CURSO.messagealert = message;
            STATE_CURSO.alerticon = iconName;
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
            d.getElementById("insert-nombreEstadoCurso").value = "";
          },
        limpiarAlertas: function (){
            STATE_CURSO.alertgeneral = null;
            STATE_CURSO.messagealert = null; 
            STATE_CURSO.alerticon = null;
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
                        STATE_CURSO.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })

        },
        
        

    }
});