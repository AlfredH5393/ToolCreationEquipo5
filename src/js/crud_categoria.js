var URL ="../controller/controller_categoria.php";
var d = document;
const CATEGORIA = new Vue({
    el: "#contenedor",
    data: {
        titleModule : 'Categorias',
        categorias : [],
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
                    CATEGORIA.totalRegistros = response.data;
                    //SE CALCULA EL TOTAL DE PAGINAS
                    CATEGORIA.paginas = Math.ceil(CATEGORIA.totalRegistros / CATEGORIA.itemsPerPage)
                    console.log(CATEGORIA.paginas);
                })
        },
        cargarDatos: function () {
            let formdata = new FormData();
            formdata.append("option", "showdata")
            axios.post(URL, formdata)
                .then(function (response) {
                    console.log(response);
                    //monedas es el arreglo de  JS 
                    CATEGORIA.categorias = response.data.categoria;
                 
                })
        },
        insertar : function(){
            //OBJETO EN JS
            let datos = {
                nombreCategoria: d.getElementById("insert-nombreCategoria").value,
              };
            console.log(datos)
            if(CATEGORIA.validarCajasVacias(datos) ){
                                     //nombre de la clase de CSS - Mensaje - clase css de icono
                CATEGORIA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = CATEGORIA.toFormData(datos,'insert');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    CATEGORIA.cargarDatos();
                    CATEGORIA.alertMessage("myalert alert-correct","Se ha registrado la Categoria exitosamente","fas fa-check bg-correct")
                    CATEGORIA.limpiarCajas();
                    setTimeout(function () {
                        CATEGORIA.limpiarAlertas();
                    }, 3000);
                    //permite actulizar la paginacion
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    CATEGORIA.alertMessage("myalert alert-fail","La categoria no pudo registrarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        CATEGORIA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
          
              
        },
        update: function(){
            let datos = {
                id: d.getElementById("update-id").value,
                nombreCategoria: d.getElementById("update-nombreCategoria").value,
              };
            console.log(datos);
            if(CATEGORIA.validarCajaUpdate(datos)){
                CATEGORIA.alertMessage("myalert alert-infoDanger","Campos vacios","fas fa-exclamation bg-infoDanger");
            }else {
            let formData = CATEGORIA.toFormData(datos,'update');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data.msj == "success") {
                    CATEGORIA.cargarDatos();
                    CATEGORIA.alertMessage("myalert alert-correct","Se ha actualizado la Categoria exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        CATEGORIA.limpiarAlertas();
                    }, 3000);
                } else {
                    CATEGORIA.alertMessage("myalert alert-fail","La Categoria no pudo actulizarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        CATEGORIA.limpiarAlertas();
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
            if(CATEGORIA.validarCajaEliminar(datos)){
                CATEGORIA.alertMessage("alert alert-danger","Campos vacios");
            }else {
            let formData = CATEGORIA.toFormData(datos,'delete');
                axios
                .post(URL, formData)
                .then(response => {
                if (response.data) {
                    CATEGORIA.cargarDatos();
                    CATEGORIA.alertMessage("myalert alert-correct","Se ha eliminado la categoria exitosamente","fas fa-check bg-correct")
                    setTimeout(function () {
                        CATEGORIA.limpiarAlertas();
                    }, 3000);
                    this.cargarTotalRegistros();
                    this.paginar(this.paginaActual);
                } else {
                    CATEGORIA.alertMessage("myalert alert-fail","La categoria no pudo eliminarce" + response.data, "fas fa-times bg-fail");
                    setTimeout(function () {
                        CATEGORIA.limpiarAlertas();
                       }, 3000);
                }
                });
            }
        },
        validarCajasVacias: function(caja){
            if( caja.nombreCategoria == 0 ){
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
            if(caja.id == 0 || caja.nombreCategoria == 0 ){
                return true;
            }
            return false
        },
        setDatos: function(category){
            d.getElementById("update-id").value = category.id;
            d.getElementById("update-nombreCategoria").value = category.nombreCategoria;
          
        },
        setDatosDelete: function(category){
            d.getElementById("delete-id").value =  category.id;
            d.getElementById("delete-nombreCategoria").value = category.nombreCategoria;
        },
        alertMessage: function( classe, message, iconName){
            CATEGORIA.alertgeneral = classe;
            CATEGORIA.messagealert = message;
            CATEGORIA.alerticon = iconName;
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
            d.getElementById("insert-nombreCategoria").value = "";
          },
        limpiarAlertas: function (){
            CATEGORIA.alertgeneral = null;
            CATEGORIA.messagealert = null; 
            CATEGORIA.alerticon = null;
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
                        CATEGORIA.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                     
            })
        },

    }
});