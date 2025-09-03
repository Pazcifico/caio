<?php $game = unserialize($_SESSION['game']); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Jogo da Velha</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="container">
    <div class="game-info">
        <div class="current-player">
            Vez de: <?= $game->currentPlayer === Game::PLAYER_ONE_ICON ? $game->players[0] : $game->players[1] ?> (<?= $game->currentPlayer ?>)
        </div>
    </div>

    <div class="position-guide">
        <strong>Posições no tabuleiro:</strong>
        <div class="position-board">
            <?php for ($i=0; $i<9; $i++): ?>
                <div class="position-cell"><?= $i ?></div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="board">
        <?php foreach ($game->board as $i => $cell): ?>
            <?php
                $classes = 'cell';
                if ($cell === Game::PLAYER_ONE_ICON) $classes .= ' x';
                if ($cell === Game::PLAYER_TWO_ICON) $classes .= ' o';
            ?>
            <?php if ($cell === Game::BLANK_ICON && $game->gameActive): ?>
                <a href="index.php?action=move&pos=<?= $i ?>" class="<?= $classes ?>"></a>
            <?php else: ?>
                <div class="<?= $classes ?>"><?= $cell ?></div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <?php if (!$game->gameActive): ?>
        <div id="gameResult" class="game-result <?= $game->winner ? 'winner' : 'draw' ?>">
            <?php if ($game->winner === Game::PLAYER_ONE_ICON): ?>
                🏆 VENCEDOR: <?= $game->players[0] ?>!
            <?php elseif ($game->winner === Game::PLAYER_TWO_ICON): ?>
                🏆 VENCEDOR: <?= $game->players[1] ?>!
            <?php else: ?>
                🤝 EMPATE!
            <?php endif; ?>
        </div>
        <a href="index.php?action=reset" class="play-again-btn">Jogar Novamente</a>
    <?php endif; ?>
</div>
</body>
</html>
