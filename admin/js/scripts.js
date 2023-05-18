//REEMPLAZAR ENLACE DE IMAGEN
const fotoProducto = document.querySelector('#fotoProducto');
const imgFoto =  document.querySelector('#imgSelect');
fotoProducto.addEventListener('change', () =>{
    imgFoto.textContent = fotoProducto.files[0].name;
    imgFoto.style.color = 'white';
    imgFoto.style.backgroundColor = '#198754';
});
//RESETEAR LOS INPUTS
const limpiar = document.querySelector('.back');
const formAdm = document.querySelector('.formAgregar');
limpiar.addEventListener('click', () =>{
    fotoProducto.value = "";
    imgFoto.style.backgroundColor = 'white';
    imgFoto.style.color = '#6c757d';
    imgFoto.textContent = 'Elija una imagen';
    formAdm.reset();
});