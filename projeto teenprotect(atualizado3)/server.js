/*const express = require("express");
const cors = require('cors');
const path = require("path");

const app = express();

app.use(cors());
*//*
app.get('/', (req, res) => {
    res.send('CORS habilitado');
});*/
/*
app.use(express.static(__dirname));

app.use((req, res) => {
    res.sendFile(path.join(__dirname, "index.html"));
});

app.listen(3000, () => {
    console.log("Servidor rodando");
});*/

const express = require("express");
const path = require("path");
const { createProxyMiddleware } = require("http-proxy-middleware");

const app = express();

// Arquivos estáticos
app.use(express.static(__dirname));

// Encaminha qualquer arquivo .php para o servidor PHP
app.use((req, res, next) => {

    if (req.path.endsWith(".php")) {

        return createProxyMiddleware({
            target: "http://localhost:8000",
            changeOrigin: true
        })(req, res, next);

    }

    next();

});

// SPA
app.use((req, res) => {
    res.sendFile(path.join(__dirname, "index.html"));
});

app.listen(3000, () => {
    console.log("Servidor Node em http://localhost:3000");
});