//VENTANA SLIDE
const ventana = document.querySelector('#ventana');
const cVentana = document.querySelector('#c-ventana');
const menuVerti = document.querySelector('.menu');
const linked = document.querySelector('.enlace');

ventana.addEventListener('click', function(){
    menuVerti.style.justifyContent = 'space-around';
    menuVerti.style.flexDirection = 'column';
    menuVerti.style.height = '60vh';
    linked.style.display = 'flex';
    linked.style.flexDirection = 'column';
    linked.style.height = '30vh';
    ventana.style.display = 'none';
    cVentana.style.display = 'block';
});

cVentana.addEventListener('click', function(){
    linked.style.display = 'none';
    menuVerti.style.justifyContent = 'space-between';
    menuVerti.style.flexDirection = 'row';
    menuVerti.style.height = '10vh';
    cVentana.style.display = 'none';
    ventana.style.display = 'block';
});