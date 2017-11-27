<?php

/**
 * Un joueur
 */
abstract class Player
{

	/**
	 * Le match en cours de jeu
	 *
	 * @var Match
	 */
	public $match;

	/**
	 * Le numéro de joueur dans le match en cours
	 *
	 * @var integer
	 */
	public $number;

	/**
	 * Permet de créer un joueur en initialisant le match et le numéro de joueur.
	 * Ce constructeur va permettre de changer la stratégie d'un joueur en cours de match.
	 *
	 * @param Match $match
	 * @param int   $number
	 */
	public function __construct(Match $match = null, int $number = 0)
	{
		$this->match  = $match;
		$this->number = $number;
	}

	/**
	 * Cette fonction calcule la décision du joueur de mettre une pièce ou non au prochain tour de jeu
	 *
	 * @return boolean
	 */
	public abstract function decides() : bool;

	/**
	 * @param string $player_class
	 * @return boolean
	 */
	public function decidesLikeA($player_class) : bool
	{
		/** @var $other_player_strategy Player */
		$other_player_strategy = new $player_class($this->match, $this->number);
		return $other_player_strategy->decides();
	}

	/**
	 * Permet de savoir si l'autre joueur a déjà triché au moins une fois pendant le match en cours
	 *
	 * @return boolean
	 */
	public function otherPlayerHasCheated() : bool
	{
		$other_player_has_cheated = false;
		$other_player_number      = self::otherPlayerNumber($this->number);
		foreach ($this->match->rounds as $round) {
			if (!$round->player_put_coin[$other_player_number]) {
				$other_player_has_cheated = true;
				break;
			}
		}
		return $other_player_has_cheated;
	}

	/**
	 * Calcule le numéro de l'autre joueur
	 *
	 * @example si je suis le joueur numéro 1, l'autre joueur est le joueur numéro 2 : 3 - 1 = 2
	 * @example si je suis le joueur numéro 2, l'autre joueur est le joueur numéro 1 : 3 - 2 = 1
	 * @param integer $player_number @values 1, 2
	 * @return integer @values 1, 2
	 */
	public static function otherPlayerNumber(int $player_number) : int
	{
		return 3 - $player_number;
	}

}
