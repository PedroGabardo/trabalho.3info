<?php

$erro = false;

require('carregar_pdo.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id         = (INT) $_POST['id'] ?? false;
    $comandante = $_POST['nome'] ?? false;
    $link       = $_POST['link'] ?? false;
    $standings  = $_POST['standings'] ?? false;
    $posicao    = $_POST['posicao'] ?? false;
    $arquetipo  = $_POST['arquetipo'] ?? false;

    if (!$id || !$comandante || !$link || !$standings || !$posicao || !$arquetipo) {
        $erro = 'Preencha corretamente!';
    } else {
        $dados = $pdo->prepare('UPDATE decks SET comandante = ?, link = ?, standings = ?, posicao = ?, arquetipo = ? WHERE id = ?');

        $dados->bindParam(1, $comandante);
        $dados->bindParam(2, $link);
        $dados->bindParam(3, $standings);
        $dados->bindParam(4, $posicao);
        $dados->bindParam(5, $arquetipo);
        $dados->bindParam(6, $id);

        $dados->execute();

        header('location:index.php');
        die;
    }
}

$id = (INT) $_GET['id'] ?? false;

if (!$id) {
    header('location:index.php');
    die;
}

require('carregar_twig.php');

$dados = $pdo->prepare('SELECT * FROM decks WHERE id = :id');
$dados->execute([':id' => $id]);

if ($dados->rowCount() != 1) {
    header('location:index.php');
    die;
}

$deck = $dados->fetch(PDO::FETCH_ASSOC);

echo $twig->render('decks_editar.html', [
    'deck' => $deck,
    'erro' => $erro,
]);
