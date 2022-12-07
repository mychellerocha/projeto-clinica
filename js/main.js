//selecionando elementos do arquivo html
const body = document.querySelector("body");
const nav = document.querySelector("nav");
const tema = document.querySelector(".botao-tema");

//tema claro-escuro
tema.addEventListener("click" , () => {
    tema.classList.toggle("ativo");
    body.classList.toggle("dark");
});
