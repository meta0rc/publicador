
const botao = document.getElementById("btn-sim");
const mudar = document.getElementById("opacityZero");
const not = document.getElementById("btn-no");
function remover(){
    mudar.classList.remove("opac");
    not.classList.add("opac");
}
botao.addEventListener("click", remover);

function inserido(){
    alert("WhatsApp Adicionado");
}