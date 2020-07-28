class clsCerrarSesion{
    constructor(URL, option){
        this.URL = URL;
        this.option = option;
    }

    closeSesion = () =>{
        let result;
        let forData = new FormData();
        forData.append('option',this.option)
        axios.post(this.URL, formdata)
                .then(function (response) {
                    console.log(response);
                 result = response.data;
                 
                })
      return result;
    }
}
export default clsCerrarSesion;