const URL2 ="../controller/controller_login.php";
const CLOSE_LOGIN = new Vue({
    el:"#contenedor",
    data:{
        alertgeneral: null,
        messagealert: null,
        alerticon: null,
    },
    methods:{
        closeSesion: () =>{
            let formdata = new FormData();
            formdata.append('option','destroySesion');
                    axios.post(URL2, formdata)
                    .then(function (response) {
                        console.log(response);
                    if(response.data == "1"){
                        window.location.href = "../public/login.html";
                    }else{
                        CLOSE_LOGIN.alertMessage("myalert alert-fail","Hubo un error al  cerrar sesion" + response.data, "fas fa-times bg-fail");
                    }
                  })
               
           
        },
        alertMessage: function( classe, message, iconName){
            CLOSE_LOGIN.alertgeneral = classe;
            CLOSE_LOGIN.messagealert = message;
            CLOSE_LOGIN.alerticon = iconName;
        },
    }
}) 

