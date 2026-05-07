<?php 

$erro = false;
 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comandante = $_POST['nome'] ?? false;
    $link       = $_POST['link'] ?? false;
    $standings  = $_POST['standings'] ?? false;
    $posicao    = $_POST['posicao'] ?? false;
    $arquetipo  = $_POST['arquetipo'] ?? false;

    if (!$comandante || !$link || !$standings || !$posicao || !$arquetipo) {
        $erro = 'Dados inválidos ou em branco!';
    } else {
        require('carregar_pdo.php');
        $dados = $pdo->prepare('INSERT INTO decks (comandante, link, standings, posicao, arquetipo) VALUES (?, ?, ?, ?, ?)');

        $dados->bindParam(1, $comandante);
        $dados->bindParam(2, $link);
        $dados->bindParam(3, $standings);
        $dados->bindParam(4, $posicao);
        $dados->bindParam(5, $arquetipo);

        $dados->execute();

        header('location:decks.php');
        die;
    }
}

require('carregar_twig.php');

echo $twig->render('decks_inserir.html', [
    'erro' => $erro
]);
