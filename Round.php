<?php

/**
 * Tour de jeu
 */
class Round
{

	/**
	 * Lorsqu'un joueur met une pièce, l'autre joueur gagne ce nombre de pièces
	 *
	 * @var integer
	 */
	public $gain = 3;

	/**
	 * Le match dans lequel s'inscrit ce tour de jeu
	 *
	 * @var Match
	 */
	public $match;

	/**
	 * Est-ce que le joueur N (1 ou 2) a donné une pièce ?
	 *
	 * @example $this->player_put_coin[1] pour savoir si le joueur 1 a mis une pièce
	 * @example $this->player_put_coin[2] pour savoir si le joueur 2 a mis une pièce
	 * @var boolean[] @key integer @keys 1, 2
	 */
	public $player_put_coin = [];

	/**
	 * Construction du tour de jeu : on a besoin de savoir la pièce mise par chaque joueur
	 *
	 * @param Match   $match
	 * @param boolean $player_1_put_coin
	 * @param boolean $player_2_put_coin
	 * @param integer $gain @max_value 10 @min_value 0
	 */
	public function __construct(
		Match $match, bool $player_1_put_coin, bool $player_2_put_coin, int $gain = 3
	) {
		$this->gain               = $gain;
		$this->match              = $match;
		$this->player_put_coin[1] = $player_1_put_coin;
		$this->player_put_coin[2] = $player_2_put_coin;
	}

	/**
	 * Calcule le nombre de pièces gagnées par le joueur N (1 ou 2) pendant ce tour de jeu
	 *
	 * @param integer $player_number @values 1, 2
	 * @return integer @values 0, 3
	 */
	public function player_earned_coins(int $player_number) : int
	{
		return $this->player_put_coin[Player::otherPlayerNumber($player_number)]
			? $this->gain
			: 0;
	}

	/**
	 * Score du joueur N (1 ou 2) au terme de ce tour de jeu = pièces gagnées - pièces données
	 *
	 * @param integer $player_number @values 1, 2
	 * @return integer @values 0, 2, 3
	 */
	public function player_score(int $player_number) : int
	{
		return $this->player_earned_coins($player_number)
			- intval($this->player_put_coin[$player_number]);
	}

}
