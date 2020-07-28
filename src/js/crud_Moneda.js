var URL ="../controller/controller_moneda.php";
var URL_MONEDA_FACADE_PATTERN = " ../controller/controller_facade.php";
var d = document;
const MONEDA = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Moneda',
        // arreglo que va recibir lso registros de la bd
        monedas : [],
        //trbaja con las clases de css de alertas
        alertgeneral: null,
        // Contenido del mensaje
        messagealert: null,
        // icono de la alerta
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
            // formdata.append("option", "count")
            formdata.append('functionFacade','contRegister')
            formdata.append('mudule','moneda')
           
            //AXIOS TE PERMITE HACER UNA PETICION AL SERVIDOR O BD DE FORMA ASYCRONA
            axios.post(URL_MONEDA_FACADE_PATTERN, formdata)
                .then(function (response) {
                    // RESPUENTA A LA PETICION
                    console.log(response);
                    MONEDA.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    MONEDA.paginas = Math.ceil(MONEDA.totalRegistros / MONEDA.itemsPerPage)
                    console.log(MONEDA.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            // formdata.append("option", "showdata")
            formdata.append('functionFacade','getData')
            formdata.append('mudule','moneda')
            axios.post(URL_MONEDA_FACADE_PATTERN, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    MONEDA.monedas = response.data.moneda;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreMoneda: d.getElementById("insert-nombreMoneda").value,
                valor: d.getElementById("insert-valor").value,
            
              };
            console.log(datos)
            if(MONEDA.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
                MONEDA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = MONEDA.toFormData(datos,'insert');
                axios
                .post("../controller/controller_moneda.php", formData)
                .then(response => {
                if (response.data) {
                    MONEDA.cargarDatos();
                    MONEDA.alertMessage("myalert alert-correct","Se ha registrado la Moneda exitosamente","fas fa-check bg-correct")
                    MONEDA.limpiarCajas();
                    setTimeout(function () {
                     MONEDA.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    MONEDA.alertMessage("myalert alert-fail","La Moneda no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        MONEDA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreMoneda: d.getElementById("update-nombreMoneda").value,
                valor: d.getElementById("update-valor").value
              };
            console.log(datos);
            if(MONEDA.validarCajaUpdate(datos)){
                MONEDA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = MONEDA.toFormData(datos,'update');
                axios
                .post("../controller/controller_moneda.php", formData)
                .then(response => {
                if (response.data.msj == "success") {
                    MONEDA.cargarDatos();
                    MONEDA.alertMessage("myalert alert-correct","Se ha actualizado la Moneda exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                     MONEDA.limpiarAlertas();
                    }, 3000);
                } else {
                    MONEDA.alertMessage("myalert alert-fail","La Moneda no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        MONEDA.limpiarAlertas();
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
            if(MONEDA.validarCajaEliminar(datos)){
                MONEDA.alertMessage("alert alert-danger","Campos vacios");
            }else {
            let formData = MONEDA.toFormData(datos,'delete');
                axios
                .post("../controller/controller_moneda.php", formData)
                .then(response => {
                if (response.data) {
                    MONEDA.cargarDatos();
                    MONEDA.alertMessage("myalert alert-correct","Se ha eliminado la Moneda exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                     MONEDA.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    MONEDA.alertMessage("myalert alert-fail","La Moneda no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        MONEDA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreMoneda == 0 || caja.valor == 0 ){
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
            if(caja.id == 0 || caja.nombreMoneda == 0 || caja.valor == 0  ){
                return true;
            }
            return false
        },
        setDatos: function(coin){
            d.getElementById("update-id").value = coin.id;
            d.getElementById("update-nombreMoneda").value = coin.nombreMoneda;
            d.getElementById("update-valor").value = coin.valor;
        },
        setDatosDelete: function(coin){
            d.getElementById("delete-id").value =  coin.id;
            d.getElementById("delete-nombreMoneda").value = coin.nombreMoneda;
        },
        alertMessage: function( classe, message, iconName){
            MONEDA.alertgeneral = classe;
            MONEDA.messagealert = message;
            MONEDA.alerticon = iconName;
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
            d.getElementById("insert-nombreMoneda").value = "";
            d.getElementById("insert-valor").value = "";
          },
        limpiarAlertas: function (){
           MONEDA.alertgeneral = null;
           MONEDA.messagealert = null; 
           MONEDA.alerticon = null;
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
                    MONEDA.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                   }
                    
           })

       },

    }
});