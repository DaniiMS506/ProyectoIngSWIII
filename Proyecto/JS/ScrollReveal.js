/************************************ Scroll Reveal/Animations ************************************/
ScrollReveal({
    /*reset: true,*/
    distance: '80px',
    duration: 1800,
    delay: 5
});

ScrollReveal().reveal('.container', { origin: 'top' });
ScrollReveal().reveal('.h2', { origin: 'buttom' });
ScrollReveal().reveal('.card', { origin: 'left' });
ScrollReveal().reveal('.footer', { origin: 'right' });