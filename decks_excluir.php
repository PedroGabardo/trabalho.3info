<?php
 
require('carregar_pdo.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (INT) $_POST['id'] ?? false;
    if ($id) {
        $excluir = $pdo->prepare('DELETE FROM decks WHERE id = :id');
        $excluir->bindParam(':id', $id);
        $excluir->execute();
    }
    header('location:decks.php');
    die;
}

$id = (INT) $_GET['id'] ?? false;

if (!$id) {
    header('location:decks.php');
    die;
}

require('carregar_twig.php');

$dados = $pdo->prepare('SELECT * FROM decks WHERE id = :id');
$dados->execute([':id' => $id]);

if ($dados->rowCount() != 1) {
    header('location:decks.php');
    die;
}

$deck = $dados->fetch(PDO::FETCH_ASSOC);

echo $twig->render('decks_excluir.html', [
    'deck' => $deck,
]);
