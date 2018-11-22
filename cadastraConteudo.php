<?php 
require_once("cabecalho.php");
require_once("class/Conteudo.php");
require_once("class/ConteudoDAO.php");

$conteudo = new Conteudo();
$conteudoDAO = new ConteudoDAO($conexao);

$contadorNomeConteudo = count($_POST['nomeConteudo']); 
if($contadorNomeConteudo > 0) {  
     for($i=0; $i<$contadorNomeConteudo; $i++) {

        $conteudo->setNomeConteudo($_POST['nomeConteudo'][$i]);
        $conteudo->setMaxAcerto($_POST['maxAcerto'][$i]);
        $conteudo->setMaxErro($_POST['maxErro'][$i]);

        $nomeConteudo = $conteudo->getNomeConteudo();
        $maxAcerto = $conteudo->getMaxAcerto();
        $maxErro = $conteudo->getMaxErro();
        $conteudoDAO->insereConteudo($conteudo);

        $_SESSION["success"] = "Conteúdos cadastrado com sucesso.";
        header("Location: formularioConteudo.php");
     }  
}  else {
    $_SESSION["danger"] = "Os conteúdos não puderam ser cadastrado. Tente novamente.";
    header("Location: formularioConteudo.php");
}
die();

require_once("rodape.php");
