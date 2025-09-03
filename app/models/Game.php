<?php
// Classe que representa o Jogo da Velha
class Game
{
    // Constantes para os ícones do jogo
    const BLANK_ICON = '';           // Espaço vazio no tabuleiro
    const PLAYER_ONE_ICON = 'X';     // Símbolo do jogador 1
    const PLAYER_TWO_ICON = 'O';     // Símbolo do jogador 2

    // Propriedades da classe
    public $players = [];            // Array com os nomes dos jogadores
    public $currentPlayer;           // Jogador da vez ('X' ou 'O')
    public $board = [];              // Array que representa o tabuleiro
    public $winner = null;           // Jogador vencedor, se houver
    public $gameActive = true;       // Indica se o jogo ainda está em andamento

    // Construtor da classe: inicializa jogadores, jogador atual e tabuleiro
    public function __construct($players = [])
    {
        // Se não forem passados nomes, usa strings vazias
        $this->players = $players ?: ['', ''];
        // Jogador 1 começa sempre
        $this->currentPlayer = self::PLAYER_ONE_ICON;
        // Cria um tabuleiro com 9 posições vazias
        $this->board = array_fill(0, 9, self::BLANK_ICON);
    }

    // Verifica se a posição escolhida é válida
    public function isPositionCorrect($position)
    {
        // Deve estar entre 0 e 8 e a célula precisa estar vazia
        return $position >= 0 && $position <= 8 && $this->board[$position] === self::BLANK_ICON;
    }

    // Executa uma jogada na posição escolhida
    public function makeMove($position)
    {
        // Se posição inválida ou jogo já acabou, não faz nada
        if (!$this->isPositionCorrect($position) || !$this->gameActive) {
            return;
        }

        // Marca a posição com o símbolo do jogador atual
        $this->board[$position] = $this->currentPlayer;

        // Verifica se o jogador atual venceu
        if ($this->validate($this->currentPlayer)) {
            $this->winner = $this->currentPlayer; // Define vencedor
            $this->gameActive = false;            // Finaliza o jogo
        }
        // Se o tabuleiro estiver cheio e ninguém venceu → empate
        elseif ($this->isBoardFull()) {
            $this->winner = null;                 // Empate
            $this->gameActive = false;            // Finaliza o jogo
        }
        // Caso contrário, alterna para o próximo jogador
        else {
            $this->currentPlayer = $this->swapPlayer();
        }
    }

    // Alterna o jogador atual
    public function swapPlayer()
    {
        // Se jogador atual é X, troca para O, e vice-versa
        return $this->currentPlayer === self::PLAYER_ONE_ICON
            ? self::PLAYER_TWO_ICON
            : self::PLAYER_ONE_ICON;
    }

    // Verifica se o tabuleiro está completamente cheio
    public function isBoardFull()
    {
        // Retorna true se não houver células vazias
        return !in_array(self::BLANK_ICON, $this->board);
    }

    // Verifica se o jogador passou em alguma condição de vitória
    public function validate($player)
    {
        // Todas as combinações possíveis de vitória
        $winPositions = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],   // Linhas
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],   // Colunas
            [0, 4, 8],
            [2, 4, 6]             // Diagonais
        ];

        // Percorre cada combinação de vitória
        foreach ($winPositions as $line) {
            // Verifica se o jogador ocupa todas as 3 posições
            if (
                $this->board[$line[0]] === $player &&
                $this->board[$line[1]] === $player &&
                $this->board[$line[2]] === $player
            ) {
                return true; // Jogador venceu
            }
        }

        // Nenhuma combinação foi completada → jogador não venceu
        return false;
    }
}
