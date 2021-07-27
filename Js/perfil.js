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

function mostrarNomeImagem(){
    let name_arquivo_div = document.getElementById('nome-arquivo');
    let name_arquivo = document.getElementById('file').value;
    name_arquivo_div.innerHTML = `<p class="name-arquivo">${extrairArquivo(name_arquivo)}</p>`;
}

function extrairArquivo(fullPath){
    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
    var filename = fullPath.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
    return filename;
}

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
