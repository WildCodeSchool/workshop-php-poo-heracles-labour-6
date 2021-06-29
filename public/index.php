<?php

require '../vendor/autoload.php';

use App\Arena\Arena;
use App\Arena\ArenaAugeas;

/** ⛔ Ne pas modifier ⛔ **/
session_start();

if (!empty($_GET['reset'])) {
    unset($_SESSION['arena']);
}

$arena = $_SESSION['arena'] ?? null;

/** initialisation **/
if (!$arena instanceof Arena) {
    $arena = new ArenaAugeas();
}

$_SESSION['arena'] = $arena;

try {
    if (!empty($_GET['move']) && method_exists($arena, 'move')) {
        $arena->arenaMove($_GET['move']);
    }
    if (isset($_GET['fight']) && method_exists($arena, 'battle')) {
        $arena->battle($_GET['fight']);
    }  
    if (isset($_GET['interact']) && $_GET['interact'] === 'dig' && method_exists($arena, 'digArena')) {
        $arena->digArena();
    }

    if(method_exists($arena, 'isVictory') && $arena->isVictory()) {
        $success = 'VICTORY';
    }

} catch (Exception $exception) {
    $error = $exception->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heracles Labours #6</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <h1>The Augean stables</h1>
        <a class="btn reset" href="?reset=reset">Reset</a>
    </header>
    <main>
        <div class="flash error"><?= $error ?? ''; ?></div>
        <div class="flash success"><?= $success ?? ''; ?></div>
        <div class="fighters">
            <a href="#hero">
                <div class="fighter">
                    <figure class="heracles">
                        <img src="<?= $arena->getHero()->getImage() ?>" alt="heracles">
                        <figcaption><?= $arena->getHero()->getName() ?></figcaption>
                    </figure>
                    <progress class="life" max="100" value="<?= $arena->getHero()->getLife() ?>"></progress>
                </div>
            </a>
            <?php foreach ($arena->getMonsters() as $monster) : ?>
                <div class="fighter">
                    <figure class="monster">
                        <img src="<?= $monster->getImage() ?>" alt="monster">
                        <figcaption><?= $monster->getName() . '(' . $monster->getLife() . ')' ?></figcaption>
                    </figure>
                    <progress class="life" max="100" value="<?= $monster->getLife() ?>"></progress>
                </div>
            <?php endforeach; ?>
        </div>


        <?php include 'map.php' ?>
    </main>

    <?php include 'inventory.php' ?>
    <script src="/assets/js/move.js"></script>
</body>

</html>