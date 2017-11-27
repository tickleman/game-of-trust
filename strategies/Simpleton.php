<?php

/**
 * Simpleton commence par coopérer, puis :
 * - si l'autre joueur a coopéré à son dernier tour, il faut la même chose que son dernier tour
 * - si l'autre joueur a triché à son dernier tour, il fait le contraire de son dernier tour
 */
class Simpleton extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		// si c'est le premier tour, je coopère
		if (!$this->match->rounds) {
			return true;
		}
		// pour les tours suivants : récupère le dernier tour
		$last_round          = end($this->match->rounds);
		$other_player_number = self::otherPlayerNumber($this->number);
		return $last_round->player_put_coin[$other_player_number]
			// si l'autre joueur a coopéré, je refais la même chose que j'avais fait
			? $last_round->player_put_coin[$this->number]
			// si l'autre joueur n'a pas coopéré, je fais le contraire de ce que j'avais fait
			: !$last_round->player_put_coint[$this->number];
	}

}
