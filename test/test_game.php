<?php
require_once("../log.phpc");
require_once("../game.phpc");
require_once("../snake_scorer.phpc");
require_once("../ai.phpc");

date_default_timezone_set("UTC");


//srand (100);

Log::$log_levels [Log::LOG_TYPE_MAIN] = 99;
Log::$log_levels [Log::LOG_TYPE_AI] = 99;
Log::$log_levels [Log::LOG_TYPE_GAME] = 99;

for ($i = 0; $i < 100; ++$i)
{
    $start = date("H:i:s");
    $game = new Game();

    $ai = new AI([new SnakeScorer($game, [2, 4], 1.1, 0.2, 2)]);

    $i = 0;
    while (1)
    {
        //Log::log(Log::LOG_TYPE_MAIN, 1, "i=" . $i);
        ++$i;
        //Log::log(Log::LOG_TYPE_MAIN, 1, $game->__toString());

        $all_moves = $game->getAllMoves();
        $best_move = $ai->bestMove($game, $all_moves);
        //Log::log(Log::LOG_TYPE_MAIN, 2, "Best move : " . Game::getDirectionString($best_move));
        //readline ("Enter to continue...");

        $all_moves = $game->moveAndCheck($best_move, FALSE);

        if ($all_moves == Game::GAME_OVER) break;
        if ($all_moves == Game::ERROR_NOP) break;
        //if ($i == 100) die("Stopped for debugging");
    }

    $score = $game->getScore();
    if ($score > $max_score) $max_score = $score;
    Log::log(Log::LOG_TYPE_MAIN, 1, $game->getScore());
    Log::log(Log::LOG_TYPE_MAIN, 1, "i=" . $i);
    Log::log(Log::LOG_TYPE_MAIN, 1, $game);
    Log::log(Log::LOG_TYPE_MAIN, 1, "Game Over");
    $stop = date("H:i:s");
    Log::log(Log::LOG_TYPE_MAIN, 1, "Start " . $start);
    Log::log(Log::LOG_TYPE_MAIN, 1, "Stop  " . $stop);
}
