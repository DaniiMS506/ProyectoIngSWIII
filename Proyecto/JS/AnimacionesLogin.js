//Ejecutando funciones
document.getElementById("btn_inicia_sesion").addEventListener("click", iniciarSesion);
document.getElementById("btn_registrarse").addEventListener("click", register);
window.addEventListener("resize", anchoPage);


//Variables                                            //Seleccion de .clases
var contenedor_login_register = document.querySelector(".container_login_registro");
var formulario_login = document.querySelector(".formulario_login");
var formulario_register = document.querySelector(".formulario_registro");
var caja_trasera_login = document.querySelector(".caja_trasera_login");
var caja_trasera_register = document.querySelector(".caja_trasera_registro");

//FUNCIONES
//Funcion para el responsive
function anchoPage() {
    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
    } else {
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
    }
}

anchoPage();


//Funcion para el cambio de formulario
function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

//Funcion para el cambio de formulario
function register() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block"; //al dar click en el form registrar se muestra
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

/************************************ Typed JS/Text Animations ************************************/
const typed = new Typed('.multiple-text1', {
    strings: ['Login', 'Iniciar Sesi\u00F3n'],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay: 1000,
    loop: true
});

/*REGISTRARSE*/
const typed2 = new Typed('.multiple-text2', {
    strings: ['Registrarse', 'Nuevo Usuario'],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay: 1000,
    loop: true
});