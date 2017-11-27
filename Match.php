<?php

/**
 * Un match est une série d'un certain nombre de tours de jeux (Round)
 */
class Match
{

	/**
	 * Les joueurs qui jouent ce match
	 *
	 * @example $this->player[1] pour accéder au joueur 1
	 * @example $this->player[2] pour accéder au joueur 2
	 * @var Player[] @key integer
	 */
	public $player = [];

	/**
	 * Le gain maximum pour chaque tour de jeu : quand un joueur met une pièce, l'autre gagne ça
	 *
	 * @max_value 10
	 * @min_value 0
	 * @var integer
	 */
	public $round_gain = 3;

	/**
	 * @var Round[] @key integer @max_key 20 @min_key 1
	 */
	public $rounds = [];

	/**
	 * @max_value 20
	 * @min_value 1
	 * @var integer
	 */
	public $rounds_count;

	/**
	 * Pour débuter un match, on a besoin de savoir quels joueurs vont jouer et combien de tours de
	 * jeu il y aura. On peut également préciser le gain à appliquer lorsqu'un joueur met une pièce.
	 *
	 * @param Player  $player_1
	 * @param Player  $player_2
	 * @param integer $rounds_count @max_value 20 @min_value 1
	 * @param integer $gain @max_value 10 @min_value 0
	 */
	public function __construct(Player $player_1, Player $player_2, int $rounds_count, int $gain = 3)
	{
		$player_1->match  = $this;
		$player_1->number = 1;
		$player_2->match  = $this;
		$player_2->number = 2;

		$this->player[1]    = $player_1;
		$this->player[2]    = $player_2;
		$this->round_gain   = $gain;
		$this->rounds_count = $rounds_count;
	}

	/**
	 * Permet de savoir quel est le numéro du tour de jeu en cours, c'est à dire pas encore mémorisé
	 * dans $this->rounds
	 *
	 * @return integer
	 */
	public function current_round_number() : int
	{
		return count($this->rounds) + 1;
	}

	/**
	 * Calcule le score du joueur N (1 ou 2) pour les tours de jeux déjà joués de ce match
	 *
	 * @param integer $player_number @values 1, 2
	 * @return integer
	 */
	public function player_score(int $player_number) : int
	{
		$player_score = 0;
		foreach ($this->rounds as $round) {
			$player_score += $round->player_score($player_number);
		}
		return $player_score;
	}

	/**
	 * Exécute l'ensemble des tours de jeu qui constituent ce match
	 */
	public function run()
	{
		for ($round_number = 1; $round_number <= $this->rounds_count; $round_number ++) {
			$round = new Round(
				$this,
				$this->player[1]->decides(),
				$this->player[2]->decides(),
				$this->round_gain
			);
			echo "- round $round_number : "
				. '-' . intval($round->player_put_coin[1]) . ' / -' . intval($round->player_put_coin[2])
				. ' => ' . $round->player_earned_coins(1) . ' / ' . $round->player_earned_coins(2)
				. "\n";
			$this->rounds[$round_number] = $round;
		}
	}

}
