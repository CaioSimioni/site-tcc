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
    


    public function cadastrarNoticia ($titulo , $descricao, $fonte, $data){
        
        global $pdo;
        $sql = $pdo->prepare("INSERT INTO noticia(fonte,data,descricao,titulo,imagem) value('$fonte',now(),'$descricao','$titulo',''");
        $sql->execute()
    }

    public function editarNoticia ($id_noticia, $titulo, $descricao){
        global $pdo;



    public function excluirNoticia ($id_noticia){
    global $pdo;
        $sql=$pdo->prepare( "DELETE FROM `noticia` WHERE `noticia`.`id_noticia` = '$id_noticia'");
        $sql->execute();
    }

}




?>