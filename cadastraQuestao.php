<?php 
require_once("cabecalho.php");
require_once("class/Questao.php");
require_once("class/QuestaoDAO.php");

$questao = new Questao();
$questaoDAO = new QuestaoDAO($conexao);
$conteudo_fkid = new ConteudoDAO($conexao);

$questao->setEnunciado($_POST['enunciado']);
$questao->setCorreta_id($_POST['correta_id']);

$nomeConteudo = $_POST['tipoConteudo'];
$id = $conteudo_fkid->pegaId($nomeConteudo);

if ($questaoDAO->insereQuestao($id, $questao)) {
  $lastID = $questaoDAO->pegaId();
  $flag = 1;
} else { 
  $flag = 0;
}
$contadorQntdAlternativas = count($_POST['qntdAlternativas']); 
if($contadorQntdAlternativas > 0) {  
     for($i=0; $i<$contadorQntdAlternativas; $i++) {
          if(trim($_POST['qntdAlternativas'][$i] != ''))  
          {  
            echo $lastID;
            $questao->qntdAlternativas[] = $_POST['qntdAlternativas'][$i];
            $questao->setAlternativas($questao->qntdAlternativas[$i]);
            $questaoDAO->insereQuestaoAlternativa($lastID, $questao);
          } 
     }  
}  else {
    echo "erro";
}

if ($flag == 1) {
  $_SESSION["success"] = "A questão ".$questao->getEnunciado() ." foi cadastrada com sucesso";
  echo "flag 1";
  header("Location: formularioQuestao.php");
  die();
} 
elseif($flag == 0) {
  $msg = mysqli_error($conexao);
  $_SESSION["danger"] = "A questão ".$questao->getEnunciado() ." não pode ser cadastrada.<br>Motivo: " . $msg;
  //echo "flag 0";
  header("Location: formularioQuestao.php");
 die();
}



require_once("rodape.php");