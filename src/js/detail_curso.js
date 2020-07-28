const ENDPOINT_LOG_ALUMNO   = "controller/controller_login.php";
const ENDPOINT_CURSOS = "controller/controller_curso.php";
var d = document;

//CLIENTE.alertMessage("myalert alert-infoDanger","Archivo no valido","fas fa-exclamation bg-infoDanger");
//CLIENTE.alertMessage("myalert alert-correct","Se ha eliminado el estado exitosamente","fas fa-check bg-correct")
// CLIENTE.alertMessage("myalert alert-fail","El estado no pudo eliminarce" + response.data, "fas fa-times bg-fail");

const CLIENTE = new Vue({
  el: ".content-principal",
  data: {
    alertgeneral: null,
    messagealert: null,
    alerticon: null,
    displayAlert: 'display:none',
    logeado: false,
    curdoDetailList: [],
    temasList: [],
    title: "Hola",
  },
  mounted: function() {
    this.comprobarLogeo();
    this.cargarCursoDetail();
    this.loadTemas();
    // this.loadData();
 },
  methods: {
    getDateHuman:function (dateAPI){
      return moment(dateAPI, "YYYYMMDD").fromNow();
    },
    comprobarLogeo: function(){
        let idUser =  d.getElementById('idUsuario').value;
         if(idUser == 'activo'){
             this.logeado = true;
         }
    },
    cargarCursoDetail: function(){
        d.getElementById("idCurso-detail").value;
        let getData = new FormData();
        getData.append('option','showDataCursosDetail')
        getData.append('IDCURSO',d.getElementById("idCurso-detail").value)
        axios.post(ENDPOINT_CURSOS, getData).then(function (response) {
          console.log(response);
          CLIENTE.curdoDetailList = response.data.cursoDetail;
          })
        
      },
    loadTemas: function(){
      d.getElementById("idCurso-detail").value;
      let getData = new FormData();
      getData.append('option','showdata')
      getData.append('IDCURSO',d.getElementById("idCurso-detail").value)
      axios.post('controller/controller_tema.php', getData).then(function (response) {
        console.log(response);
        CLIENTE.temasList = response.data.temas;
      })  
    },
    loadData: function(){
       console.log(this.curdoDetailList);
    },
    
    closeSesionRol: () => {
      let formdata = new FormData();
      
      formdata.append("option", "destroySesion");
      axios.post(ENDPOINT_LOG_ALUMNO, formdata).then(function (response) {
        console.log(response);
        if (response.data == "1") {
          window.location.href = "index.php";
        } else {
            CLIENTE.alertMessage(
            "myalert alert-fail",
            "Hubo un error al  cerrar sesion" + response.data,
            "fas fa-times bg-fail"
          );
        }
      });
    },
 
  irdetallecurso: function(id){
    let valor = 'idcurso='+id; 
    window.location.href = 'detailcurso.php?'+valor;
  },
  limpiarAlertas: function (){
    CLIENTE.alertgeneral = null;
    CLIENTE.messagealert = null; 
    CLIENTE.alerticon = null;
    CLIENTE.displayAlert ="display:none";
  },
  alertMessage: function (classe, message, iconName) {
    CLIENTE.displayAlert ="";
    CLIENTE.alertgeneral = classe;
    CLIENTE.messagealert = message;
    CLIENTE.alerticon = iconName;
        },
  },
  
});
