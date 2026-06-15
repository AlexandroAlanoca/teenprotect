const routes = {
    "/": "/pages/home.html",
    "/denuncia": "/pages/denuncia.php",
    "/contato": "/pages/contato.html",
    "/login": "/pages/login.php",
    /*"/login": "http://localhost:8000/pages/login.php",*/
    "/cadastro": "/pages/cadastro.php"
};

async function loadPage(pathname) {

    const route = routes[pathname];

    if (!route) {
        document.getElementById("app").innerHTML = "<h1>404</h1>";
        return;
    }

    try {

        const response = await fetch(route);

        const html = await response.text();

        document.getElementById("app").innerHTML = html;
        console.log("Página carregada");

        console.log(window.location.pathname)
        //
        if (pathname === "/") {
            const inicioHeaderBt = document.getElementById("inicioHeaderBt")
            const denunciaHeaderBt = document.getElementById("denunciaHeaderBt")
            const contatoHeaderBt = document.getElementById("contatoHeaderBt")
            
            denunciaHeaderBt.style.display = "inline-block";
            inicioHeaderBt.style.display = "none";
            contatoHeaderBt.style.display = "inline-block";
            console.log("Página de denúncia carregada");
            // Seu código para a página de denúncia
        }

        if (pathname === "/contato") {
            const inicioHeaderBt = document.getElementById("inicioHeaderBt")
            const denunciaHeaderBt = document.getElementById("denunciaHeaderBt")
            const contatoHeaderBt = document.getElementById("contatoHeaderBt")
            
            denunciaHeaderBt.style.display = "inline-block";
            inicioHeaderBt.style.display = "inline-block";
            contatoHeaderBt.style.display = "none";
            console.log("Página de denúncia carregada");
            // Seu código para a página de denúncia
        }

        if (pathname === "/denuncia") {
            const inicioHeaderBt = document.getElementById("inicioHeaderBt")
            const denunciaHeaderBt = document.getElementById("denunciaHeaderBt")
            const contatoHeaderBt = document.getElementById("contatoHeaderBt")
            
            denunciaHeaderBt.style.display = "none";
            inicioHeaderBt.style.display = "inline-block";
            contatoHeaderBt.style.display = "inline-block";
            console.log("Página de denúncia carregada");
            // Seu código para a página de denúncia
        }

        const idiomaSalvo = localStorage.getItem("idioma") || "pt";

        trocarIdioma(idiomaSalvo);
       
    } catch (error) {

        document.getElementById("app").innerHTML =
            "<h1>Erro ao carregar página</h1>";

        console.error(error);
    }
}



document.addEventListener("click", (e) => {

    const link = e.target.closest("[data-link]");

    if (!link) return;

    e.preventDefault();

    const url = link.getAttribute("href");

    history.pushState({}, "", url);

    loadPage(url);
});

window.addEventListener("popstate", () => {

    loadPage(window.location.pathname);
});

window.addEventListener("DOMContentLoaded", () => {

    loadPage(window.location.pathname);
});


//