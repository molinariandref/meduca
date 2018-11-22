<?php 
require_once("cabecalho.php");
require_once("class/Conteudo.php");
require_once("class/ConteudoDAO.php");

$conteudo = new Conteudo();
$conteudoDAO = new ConteudoDAO($conexao);


$idConteudo = $_POST['conteudo'];
$conteudo->setId($idConteudo);


$contadorPreRequisito = count($_POST['preRequisito']); 
if($contadorPreRequisito > 0) {  
     for($i=0; $i<$contadorPreRequisito; $i++) {
        $preRequisito = $_POST['preRequisito'][$i];
        $conteudoDAO->associaPreRequisito($preRequisito, $idConteudo);
     }  
} 

$contadorPosRequisito = count($_POST['posRequisito']); 
if($contadorPosRequisito > 0) {  
     for($i=0; $i<$contadorPosRequisito; $i++) {
        $posRequisito = $_POST['posRequisito'][$i];
        $conteudoDAO->associaPosRequisito($posRequisito, $idConteudo); 
     }  
} 

$_SESSION["success"] = "Associação realizada com sucesso.";
header("Location: formularioAssociarConteudo.php");


require_once("rodape.php");
