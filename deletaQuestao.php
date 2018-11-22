<?php require_once("cabecalho.php"); 
$questao = new Questao();
$enunciado = $_POST['enunciado'];
$questaoDAO = new QuestaoDAO($conexao);
$id = $_POST['enunciadoId'];
echo "id: " . $id;

$questao->setId($id);
$questao->setEnunciado($enunciado);

$q = $questao->getId();
$questaoDAO->removeQuestao($questao);

$_SESSION["danger"] = "Questão deletada com sucesso";
header("Location: visualizarQuestoes.php");
die();



?>

<?php require_once("rodape.php"); ?>
<?php require_once("script.php"); ?>
