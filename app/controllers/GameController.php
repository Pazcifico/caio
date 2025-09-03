<?php
require_once 'app/models/Game.php';

class GameController {
    public function setup() {
        include 'app/views/setup.php';
    }

    public function start() {
        $p1 = trim($_POST['player1']);
        $p2 = trim($_POST['player2']);

        if (!$p1 || !$p2) {
            $error = "Digite o nome dos dois jogadores!";
            include 'app/views/setup.php';
            return;
        }

        $game = new Game([$p1, $p2]);
        $_SESSION['game'] = serialize($game);

        include 'app/views/board.php';
    }

    public function makeMove() {
        $position = (int) $_GET['pos'];
        $game = unserialize($_SESSION['game']);

        $game->makeMove($position);
        $_SESSION['game'] = serialize($game);

        include 'app/views/board.php';
    }

    public function reset() {
        session_destroy();
        header("Location: index.php");
    }
}
