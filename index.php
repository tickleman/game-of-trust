<?php

/**
 * Programme principal : c'est ici qu'on programme ce qui va être fait
 *
 * @example
 * Pour l'appeler, depuis le terminal :
 * php index.php # deux Cooperator se battront pendant 10 tours, avec un gain de 3 pièces
 * php index.php Cooperator Cheater # permet de choisir quels seront les joueurs
 * php index.php Cooperator Cheater 7 # ils se battront pendant 7 tours
 * php index.php Cooperator Cheater 7 2 # le gain est de 2 pièces au lieu de 3
 */

include_once 'Autoloader.php';

// récupère les stratégies des joueurs à partir des paramètres

$player_1 = isset($argv[1]) ? (new $argv[1]) : new Cooperator;
$player_2 = isset($argv[2]) ? (new $argv[2]) : new Cooperator;

// récupère le nombre de tours

$rounds_count = isset($argv[3]) ? intval($argv[3]) : 10;

// récupère le gain à chaque tour de jeu

$gain = isset($argv[4]) ? intval($argv[4]) : 3;

// affiche les informations générales de jeu

echo "Match in $rounds_count rounds, gain per round = $gain\n";

// crée et lance le match

$match = new Match($player_1, $player_2, $rounds_count, $gain);
$match->run();

// affiche le score en fin de match

echo 'Score for player 1 (' . strtolower(get_class($player_1)) . ') : '
	. $match->player_score(1) . "\n";

echo 'Score for player 2 (' . strtolower(get_class($player_2)) . ') : '
	. $match->player_score(2) . "\n";
