let label = document.getElementById("btn");
let int = document.getElementById("file");

let mudarA = document.getElementById("mudarAvatar");
let x = document.getElementById("close");

function iniciaP(pop){
    const modal = document.getElementById(pop);
    modal.classList.add("mostrar");
}

function retiraP(popp){
    const modall = document.getElementById(popp);
    modall.classList.remove("mostrar");
}
mudarA.addEventListener("click", function() {
    iniciaP("popup");
})
x.addEventListener("click", function() {
    retiraP("popup");
})

label.addEventListener('click', () => {
    int.click();
    
});

let name_arquivo = document.getElementById('nome-arquivo');

function mostrarNomeImagem(){
    name_arquivo.innerHTML = "<p><?php $novo_nome?></p>"
}