const contenendor = document.querySelector('#contenedor');
const btnHamburger = document.querySelector('#btn-menu');
const btnDrop = document.querySelector('.avatar');
const dropdown = document.querySelector('#dropdown');
const wrapTable = document.querySelector('#wrap-table');


btnDrop.addEventListener('click', ()=> {
    dropdown.classList.toggle("active")
    // dropdown.classList.toggle('right');
})

btnHamburger.addEventListener('click', () =>{
    contenendor.classList.toggle('active');
    wrapTable.classList.toggle('active');
})

const comprobarAncho = () =>{
    if(window.innerWidth <= 768){
        contenendor.classList.remove('active');
    }else{
        contenendor.classList.add('active');
    }   
}

comprobarAncho();

// Window.addEventListener('resize', () =>{  
//     comprobarAncho();
// })