<?php
session_start();

class Noticia{
    private $pdo;
    public $msgError = "";

    /*
        Atribudos Notícia
        * id_noticia
        * titulo
        * conteúdo
        * data
    */

    public function cadastrarNoticia ($titulo , $conteudo){

    }

    public function editarNoticia ($id_noticia, $titulo, $conteudo){

    }

    public function excluirNoticia ($id_noticia){

    }

}

?>