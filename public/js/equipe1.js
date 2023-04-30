try {


const Showmembre = document.getElementById('Showmembre');
const Showdemande = document.getElementById('Showdemande');
const membre = document.getElementById('membre');
const demande = document.getElementById('demande');

function showmembre() {
    membre.style.display = null;
    demande.style.display = 'none'
    Showmembre.classList.add('active')
    Showdemande.classList.remove('active')
}

function showdemande() {
    membre.style.display = 'none';
    demande.style.display = null
    Showmembre.classList.remove('active')
    Showdemande.classList.add('active')
}

Showmembre.addEventListener('click', showmembre);

Showdemande.addEventListener('click', showdemande)

window.addEventListener('load', ()=>{
    if (window.location.hash ==='#demande') {
        showdemande()
    } else {
        showmembre()
    }
})
console.log(Showdemande, Showmembre);
} catch (error) {

}
