<?php
include_once("class/Categoria.Class.php");
include_once("class/Produto.Class.php");

//Adicionar Categoria BD
//$categoria = Categoria(1);
//$produto   = new Produto();
//echo $produto->getId();
//echo $produto->getNome();
//echo $produto->getPreco();

//Adicionar Produtos BD
//$produto = new Produto();
//$produto->setCategoria_id(2);
//$produto->setNome('Maquina');
//$produto->setPreco(350);
//$produto->setQuantidade(200);
//$produto->adicionar();

$produtos = Produto::Listar();
if($produtos){
    foreach($produtos as $produto){
        echo $produto->getId();
        echo '<pre>';
        echo $produto->getCategoria_id();
        echo '<pre>';
        echo $produto->getNome();
        echo '<pre>';
        echo $produto->getPreco();
        echo '<pre>';
        echo $produto->getQuantidade();
    }
}
?>