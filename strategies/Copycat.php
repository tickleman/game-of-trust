<?php

/**
 * Au premier tour, Copycat donne une pièce.
 * Pour chaque tour suivant, il jouera exactement ce que l'autre joueur a joué au tour précédent
 */
class Copycat extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		if (!$this->match->rounds) {
			return true;
		}
		$last_round          = end($this->match->rounds);
		$other_player_number = self::otherPlayerNumber($this->number);
		$other_player_put    = $last_round->player_put_coin[$other_player_number];
		return $other_player_put;
	}

}
