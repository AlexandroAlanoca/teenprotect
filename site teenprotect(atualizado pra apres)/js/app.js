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

        const idiomaSalvo =
                localStorage.getItem("idioma") || "pt";

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