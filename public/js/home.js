const anonce = document.getElementById('anonce');
const equipe = document.getElementById('equipe');
// nav
const Anonce = document.getElementById('Anonce');
const Equipe = document.getElementById('Equipe');

function show() {
    if (window.location.hash =='#equipe') {
        equipe.style.display = null;
        anonce.style.display = 'none';
        Anonce.classList.remove('active')
        Equipe.classList.add('active')
    } else{
        anonce.style.display = null;
        equipe.style.display = 'none';
        Equipe.classList.remove('active')
        Anonce.classList.add('active')
    }
}

Anonce.addEventListener('click', ()=>{
    anonce.style.display = null;
    equipe.style.display = 'none';
    Equipe.classList.remove('active')
    Anonce.classList.add('active')
})

Equipe.addEventListener('click', ()=>{
    equipe.style.display = null;
    anonce.style.display = 'none';
    Anonce.classList.remove('active')
    Equipe.classList.add('active')
})

window.addEventListener('load', ()=>{
    show();
})
