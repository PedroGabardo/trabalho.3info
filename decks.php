<?php 

require('carregar_twig.php');
require('carregar_pdo.php');

$decks = $pdo->query('SELECT * FROM decks');
$todosdecks = $decks->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('decks.html', [
    'decks' => $todosdecks,
]);
 