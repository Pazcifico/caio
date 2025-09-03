<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Jogo da Velha</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="container">
    <h1 class="title">🎮 Jogo da Velha</h1>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <div class="player-setup">
        <form action="index.php?action=start" method="POST" class="player-input">
            <input type="text" name="player1" placeholder="Player 1 (X) - Digite o seu nome" maxlength="20">
            <input type="text" name="player2" placeholder="Player 2 (O) - Digite o seu nome" maxlength="20">
            <button class="start-btn" type="submit">Iniciar Jogo</button>
        </form>
    </div>
</div>
</body>
</html>
