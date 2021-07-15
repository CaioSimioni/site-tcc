<?php

class Noticia{
    private $pdo;
    public $msgError = "";

    /*
        Atribudos Notícia
        * id_noticia
        * titulo
        * descricao
        * fonte
        * path_imagem
        * data
    */

    public function cadastrarNoticia ($titulo , $descricao, $fonte, $path_imagem, $data){
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO `noticia`(`fonte`, `data`, `descricao`, `titulo`, `imagem`) 
        VALUES($fonte)");
    }

    public function editarNoticia ($id_noticia, $titulo, $descricao, $fonte, $path_imagem){

    }

    public function excluirNoticia ($id_noticia){

    }

}

?>