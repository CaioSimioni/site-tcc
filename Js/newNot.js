if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

let i = document.getElementById("newNoticia_imagem")
function a() {
    i.click()
}


function mostrarNomeImagem(){
    let name_arquivo_div = document.getElementById('nome-arquivo');
    let name_arquivo = document.getElementById('newNoticia_imagem').value;
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