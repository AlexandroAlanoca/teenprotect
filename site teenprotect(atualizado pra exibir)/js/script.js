//Abrir e fechar menu lateral
function menuShow() {
    let menuMobile = document.querySelector('.menu-lateral');
    menuMobile.classList.toggle("open");
    let menuOverlay = document.querySelector('.menu-overlay');
    menuOverlay.classList.toggle("open");
}

function menuClose() {
    let menuMobile = document.querySelector('.menu-lateral');
    menuMobile.classList.toggle("open");
    let menuOverlay = document.querySelector('.menu-overlay');
    menuOverlay.classList.toggle("open");
}

//funcao de sair do menu lateral ao apertar a tecla ESC
document.addEventListener('keydown', function (evento) {
    // Verifica se a tecla pressionada é 'Esc'
    if (evento.key === 'Escape' || evento.keyCode === 27) {
        // Verifica se o overlay está visível antes de tentar fechar
        const overlay = document.querySelector('.menu-overlay');
        if (overlay.classList.contains('open')) {
            menuClose();
        }
    }
});
//--------botoes header ---------
//arrumar, se der, esta parte quando eu volto pra pagina anterior, o elemento continua salvo como da pagina de antes da anterior 

const inicioHBt = sessionStorage.getItem("inicioHBt")
const inicioDBt = sessionStorage.getItem("inicioDBt")
const inicioCBt = sessionStorage.getItem("inicioCBt")
const logoHeaderBtShow = document.getElementById("logoBt2")
const inicioHeaderBtShow = document.getElementById("inicioHeaderBt");
const denunciaHeaderBtShow = document.getElementById("denunciaHeaderBt");
const contatoHeaderBtShow = document.getElementById("contatoHeaderBt");

if(inicioHBt === "oculto"){
    inicioHeaderBt.style.display = "none";
    denunciaHeaderBt.style.display = "inline-block";
    contatoHeaderBt.style.display = "inline-block";
    console.log("inicio oculto")
}

if(inicioDBt === "oculto"){
    denunciaHeaderBt.style.display = "none";
    inicioHeaderBt.style.display = "inline-block";
    contatoHeaderBt.style.display = "inline-block";
    console.log("D oculto")
}

if(inicioCBt === "oculto"){
    contatoHeaderBt.style.display = "none";
    denunciaHeaderBt.style.display = "inline-block";
    inicioHeaderBt.style.display = "inline-block";
    console.log("c oculto")
}

logoHeaderBtShow.addEventListener("click", (e) => {
    const inicioHeaderBt = document.getElementById("inicioHeaderBt")
    const denunciaHeaderBt = document.getElementById("denunciaHeaderBt")
    const contatoHeaderBt = document.getElementById("contatoHeaderBt")
    inicioHeaderBt.style.display = "none";
    denunciaHeaderBt.style.display = "inline-block";
    contatoHeaderBt.style.display = "inline-block";
    sessionStorage.setItem('inicioHBt', "oculto");
    sessionStorage.setItem('inicioDBt', "visivel");
    sessionStorage.setItem('inicioCBt', "visivel");
    console.log(sessionStorage.getItem("inicioHBt"))
});

inicioHeaderBtShow.addEventListener("click", (e) => {
    const inicioHeaderBt = document.getElementById("inicioHeaderBt")
    const denunciaHeaderBt = document.getElementById("denunciaHeaderBt")
    const contatoHeaderBt = document.getElementById("contatoHeaderBt")
    inicioHeaderBt.style.display = "none";
    denunciaHeaderBt.style.display = "inline-block";
    contatoHeaderBt.style.display = "inline-block";
    sessionStorage.setItem('inicioHBt', "oculto");
    sessionStorage.setItem('inicioDBt', "visivel");
    sessionStorage.setItem('inicioCBt', "visivel");
    console.log(sessionStorage.getItem("inicioHBt"))
});



denunciaHeaderBtShow.addEventListener("click", (e) => {
    const inicioHeaderBt = document.getElementById("inicioHeaderBt")
    const denunciaHeaderBt = document.getElementById("denunciaHeaderBt")
    const contatoHeaderBt = document.getElementById("contatoHeaderBt")
    inicioHeaderBt.style.display = "inline-block";
    denunciaHeaderBt.style.display = "none";
    contatoHeaderBt.style.display = "inline-block";
    sessionStorage.setItem('inicioHBt', "visivel");
    sessionStorage.setItem('inicioDBt', "oculto");
    sessionStorage.setItem('inicioCBt', "visivel");
    console.log(sessionStorage.getItem("inicioDBt"))
});



contatoHeaderBtShow.addEventListener("click", (e) => {
    const contatoHeaderBt = document.getElementById("contatoHeaderBt")
    const inicioHeaderBt = document.getElementById("inicioHeaderBt")
    const denunciaHeaderBt = document.getElementById("denunciaHeaderBt")
    inicioHeaderBt.style.display = "inline-block";
    contatoHeaderBt.style.display = "none";
    denunciaHeaderBt.style.display = "inline-block";
    sessionStorage.setItem('inicioHBt', "visivel");
    sessionStorage.setItem('inicioDBt', "visivel");
    sessionStorage.setItem('inicioCBt', "oculto");
    console.log(sessionStorage.getItem("inicioCBt"))
});



//modo escuro e claro
/*const radios = document.getElementsByName('tema');

radios.forEach(radio => {
    radio.addEventListener('change', () => {
        let homePage = document.querySelector(".home-page");
        let content = document.querySelector(".text-content"); 
        let denunciaPage = document.querySelector(".denuncia-page");

        if (radio.value == 'dark') {
            if(homePage){//testar depois o porque do .dark so exibir no h1 e nos outros nao no dom

                homePage.classList.add("dark");
                homePage.classList.remove("light");
                content.classList.add("dark");
                content.classList.remove("light");
            }
            
            if(denunciaPage){
                denunciaPage.classList.add("dark");
                denunciaPage.classList.remove("light");
                content.classList.add("dark");
                content.classList.remove("light");
            }
            
        }
        if (radio.value == 'light') {
            if(homePage){
                homePage.classList.add("light");
                homePage.classList.remove("dark");
                content.classList.add("light");
                content.classList.remove("dark");
            }
            
            if(denunciaPage){
                denunciaPage.classList.add("light");
                denunciaPage.classList.remove("dark");
                content.classList.add("light");
                content.classList.remove("dark");
            }
            
        }
        if (radio.checked) {
            console.log(radio.value);
        }

    })
});*/

// Traduções
const traducoes = {

    pt: {
        title: "O que é aliciamento?",
        text: "O aliciamento nas mídias sociais ocorre quando alguém utiliza plataformas digitais para ganhar a confiança de outra pessoa com o objetivo de manipulá-la, explorá-la ou envolvê-la em atividades prejudiciais. Esse processo geralmente acontece de forma gradual. O aliciador pode se passar por alguém confiável, criar vínculos emocionais e, aos poucos, induzir a vítima a tomar decisões que podem colocá-la em perigo.",
        title2: "Como acontece?",
        text2: "O aliciamento costuma seguir alguns padrões:",
        textLi1: "Contato inicial amigável: o agressor inicia uma conversa de forma aparentemente inocente;",
        textLi2: "Criação de confiança: demonstra interesse, atenção e apoio emocional;",
        textLi3: "Isolamento: tenta afastar a vítima de amigos e familiares;",
        textLi4: "Manipulação emocional: usa ameaças, chantagens ou promessas falsas;",
        textLi5: "Exploração: pode envolver envio de imagens, encontros presenciais ou atividades ilegais.",
        title3: "Como se proteger?",
        text3: "Algumas atitudes simples podem fazer grande diferença:",
        textLi6: "Não compartilhe informações pessoais com desconhecidos;",
        textLi7: "Configure a privacidade das suas redes sociais;",
        textLi8: "Evite aceitar solicitações de pessoas que você não conhece;",
        textLi9: "Converse com alguém de confiança se algo parecer errado;",
        textLi10: "Nunca envie fotos íntimas para pessoas desconhecidas.",
        title4: "Denuncie",
        text4: "Ao identificar qualquer situação suspeita, denuncie imediatamente. Sua ação pode salvar vidas.",
        textBt: "Fazer denuncia",
        reportBt: "Denúncie",
        contactBt: "Contato"
    },

    en: {
        title: "What is grooming?",
        text: "Social media grooming occurs when someone uses digital platforms to gain another person’s trust in order to manipulate, exploit, or engage them in harmful activities. This process usually happens gradually. The enticer can impersonate someone trustworthy, create emotional bonds and gradually induce the victim to make decisions that may put her in danger.",
        title2: "how does it happen? ",
        text2: "Enticement often follows a few standards:",
        textLi1: "Friendly initial contact: the attacker starts a conversation in a seemingly innocent way;",
        textLi2: "",
        textLi3: "",
        textLi4: "",
        textLi5: "",
        title3: "",
        text3: "",
        textLi6: "",
        textLi7: "",
        textLi8: "",
        textLi9: "",
        textLi10: "",
        title4: "",
        text4: "",
        textBt: "",
        reportBt: "Report",
        contactBt: "Contact"
    },

    es: {
        title: "¿Qué es el acoso?",
        text: "Texto en español",
        title2: "how does it happen? ",
        text2: "",
        textLi1: "",
        textLi2: "",
        textLi3: "",
        textLi4: "",
        textLi5: "",
        title3: "",
        text3: "",
        textLi6: "",
        textLi7: "",
        textLi8: "",
        textLi9: "",
        textLi10: "",
        title4: "",
        text4: "",
        textBt: ""
    }

};

// Função global
function trocarIdioma(idioma) {

    const elementos = document.querySelectorAll("[data-i18n]");

    elementos.forEach(elemento => {

        const chave = elemento.dataset.i18n;

        if (
            traducoes[idioma] &&
            traducoes[idioma][chave]
        ) {

            elemento.textContent =
                traducoes[idioma][chave];

        }

    });

    localStorage.setItem("idioma", idioma);

}

// Radios
const radios2 = document.querySelectorAll('input[name="idioma"]');

radios2.forEach(radio => {

    radio.addEventListener("change", () => {

        trocarIdioma(radio.value);

    });

});

// Recupera idioma salvo
const idiomaSalvo = localStorage.getItem("idioma") || "pt";

// Marca radio salvo
radios2.forEach(radio => {

    radio.checked =
        radio.value === idiomaSalvo;

});