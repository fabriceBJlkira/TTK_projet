try {
    var gameinfo = document.getElementById('gameinfo')
    var userinfo = document.getElementById('userinfo')
    var userInfo = document.getElementById('userInfo')
    var gammeInfo = document.getElementById('gammeInfo')



    try {
        function showuserInfo() {
            userInfo.style.display = null;
            userinfo.classList.add('active');
            gammeInfo.style.display = 'none';
            gameinfo.classList.remove('active');
        }
        function showgameInfo() {
            userInfo.style.display = 'none';
            userinfo.classList.remove('active');
            gammeInfo.style.display = null;
            gameinfo.classList.add('active');
        }

        userinfo.addEventListener('click', showuserInfo);
        gameinfo.addEventListener('click', showgameInfo);
    } catch (error) {

    }


    // image
    let imgc = document.getElementById('imgc');
    let imgp = document.getElementById('imgp');
    imgp.onchange = ()=> {
        let reader = new FileReader();
        reader.readAsDataURL(imgp.files[0]);
        reader.onload = ()=>{
            imgc.setAttribute("src", reader.result);
        }
    }

    // ce script permet voir email et mot de passe
    var check = document.getElementById('check');
    var Aemail = document.getElementById('Aemail');
    var Nemail = document.getElementById('Nemail');
    var Amdp = document.getElementById('Amdp');
    var Nmdp = document.getElementById('Nmdp');
    function showemailpassword(a, b, c, d) {
        if (check.checked) {
            b.style.display = null;
            b.children[1].removeAttribute('disabled')
            a.style.display = null;
            a.children[1].removeAttribute('disabled')
            c.style.display = null;
            c.children[1].removeAttribute('disabled')
            d.style.display = null;
            d.children[1].removeAttribute('disabled')
        } else {
            a.style.display = 'none';
            b.style.display = 'none';
            c.style.display = 'none';
            d.style.display = 'none';
            a.children[1].setAttribute('disabled', true)
            b.children[1].setAttribute('disabled', true)
            c.children[1].setAttribute('disabled', true)
            d.children[1].setAttribute('disabled', true)
        }
    }

    var eror = document.querySelectorAll('.eror');

    try {
        function hidealert(a) {
            a.style.display = 'none';
            window.location.pathname = ''
        }
    } catch (error) {

    }

    window.addEventListener('load', ()=>{
        if (window.location.hash === '#gameInfo') {
            showgameInfo();
        } else {
            showuserInfo()
        };

        showemailpassword(Aemail, Nemail, Amdp, Nmdp);
        eror.forEach((ereur) => {
            if (ereur.textContent !== '') {
                check.checked =true
                showemailpassword(Aemail, Nemail, Amdp, Nmdp);
            }
        });
    })
} catch (error) {

}
