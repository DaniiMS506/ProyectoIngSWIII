// Obtener elementos del DOM
let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');

let carouselDom = document.querySelector('.carousel');
let SliderDom = carouselDom.querySelector('.carousel .list');
let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
let timeDom = document.querySelector('.carousel .time');

// Ajusta los tiempos como desees
let timeRunning = 3000;
let timeAutoNext = 20000; // 20 segundos (20000 ms)

// Función para avanzar al siguiente slider
nextDom.onclick = function () {
    showSlider('next');
    restartAutoNextTimer(); // Reiniciar el temporizador automático
}

// Función para retroceder al slider anterior
prevDom.onclick = function () {
    showSlider('prev');
    restartAutoNextTimer(); // Reiniciar el temporizador automático
}

let runTimeOut;
let runNextAuto;

// Función para mostrar el slider según el tipo (next o prev)
function showSlider(type) {
    let SliderItemsDom = SliderDom.querySelectorAll('.carousel .list .item');
    let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');

    if (type === 'next') {
        SliderDom.appendChild(SliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        carouselDom.classList.add('next');
    } else {
        SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
        thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        carouselDom.classList.add('prev');
    }
    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
    }, timeRunning);

    restartAutoNextTimer(); // Reiniciar el temporizador automático
}

// Función para reiniciar el temporizador automático
function restartAutoNextTimer() {
    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        nextDom.click(); // Hacer clic en el botón next automáticamente
    }, timeAutoNext);
}

// Iniciar el cambio automático de imágenes al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    restartAutoNextTimer(); // Iniciar el temporizador automático al cargar la página
});



/************************************ Scroll Reveal/Animations ************************************/
ScrollReveal({
    /*reset: true,*/
    distance: '80px',
    duration: 1800,
    delay: 5
});

ScrollReveal().reveal('.navbar, .carousel', { origin: 'top' });
//ScrollReveal().reveal('.content', { origin: 'buttom' });
ScrollReveal().reveal('.arrows', { origin: 'left' });
ScrollReveal().reveal('.thumbnail', { origin: 'right' });


/************************************ Read More ************************************/

// Declaración de textos
const rm1 = 'Nike Air Mag Exclusivas';
const rm2 = 'Colaboracion entre Nike y Louis Vuitton';
const rm3 = 'Air Jordan 1 Retro';
const rm4 = 'Nike Air Force 1';

// Función para mostrar SweetAlert
function readmore(texto) {
    let titleText = '';
    switch (texto) {
        case 'rm1':
            titleText = rm1;
            break;
        case 'rm2':
            titleText = rm2;
            break;
        case 'rm3':
            titleText = rm3;
            break;
        case 'rm4':
            titleText = rm4;
            break;
        default:
            titleText = 'Carousel creado por K. Daniel';
            break;
    }

    Swal.fire({
        title: titleText,
        showClass: {
            popup: `
            animate__animated
            animate__fadeInUp
            animate__faster
        `
        },
        hideClass: {
            popup: `
            animate__animated
            animate__fadeOutDown
            animate__faster
        `
        }
    });
};