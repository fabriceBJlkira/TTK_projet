const sec1 = document.getElementById('sec1');
const sec2 = document.getElementById('sec2');
const sec3 = document.getElementById('sec3');

sec2.style.display='none';
sec3.style.display='none';


const suivant1 = document.getElementById('suivant1')
const suivant2 = document.getElementById('suivant2')
const precedent1 = document.getElementById('precedent1')
const precedent2 = document.getElementById('precedent2')
var eror = 'ce champ estobligatoire';
// validation
var nom = document.getElementById('nom');
var email = document.getElementById('email');
var password = document.getElementById('password');
const form1 = document.getElementById('form1');

nom.addEventListener('focus', ()=>{
    nom.value = '';
    nom.style.border = 'solid 1px #ccc'
    nom.style.color = 'black'
})
try {
    email.addEventListener('focus', ()=>{
        email.value = '';
        email.style.border = 'solid 1px #ccc'
        email.style.color = 'black'
    })

    password.addEventListener('focus', ()=>{
        password.value = '';
        password.style.border = 'solid 1px #ccc'
        password.style.color = 'black'
    })
} catch (error) {

}

suivant1.addEventListener('click', ()=>{
    if (nom.value !== '' && nom.value !== eror) {
        sec1.style.display='none';
        sec2.style.display= null;
        sec3.style.display='none';
    } else {
        nom.style.color = 'red'
        nom.value = eror;
        nom.style.border = 'solid 3px red'
    }
})

try {
    suivant2.addEventListener('click', ()=>{
        sec1.style.display='none';
        sec3.style.display= null;
        sec2.style.display='none';
    })

    precedent1.addEventListener('click', ()=>{
        sec2.style.display='none';
        sec3.style.display='none';
        sec1.style.display= null;
    })
} catch (error) {

}

try {
    precedent2.addEventListener('click', ()=>{
        sec1.style.display='none';
        sec3.style.display='none';
        sec2.style.display= null;
    })
} catch (error) {

}
// photos de profil
let avatar = document.getElementById('avatar');
let fileavatar = document.getElementById('fileavatar');
try {
    fileavatar.onchange = ()=> {
        let reader = new FileReader();
        reader.readAsDataURL(fileavatar.files[0]);
        reader.onload = ()=>{
            avatar.setAttribute("src", reader.result);
        }
    }
} catch (error) {
    console.log(error);
}

try {
    form1.addEventListener('submit', (e)=>{
        if (email.value === '' || email.value === eror) {
            e.preventDefault();
            email.style.border= 'solid 3px red'
            email.style.color= 'red'
            email.value= eror
        } else if (password.value === '') {
            e.preventDefault();
            password.style.border= 'solid 3px red'
        } else {
            var validate = confirm('Voulez vous envoyer le formulaire ?')
            if (validate === false) {
                e.preventDefault();
            }
        }
    })
} catch (error) {

}
try {
    function hidealert(a) {
        a.style.display = 'none';
        window.location.pathname = ''
    }
} catch (error) {

}
