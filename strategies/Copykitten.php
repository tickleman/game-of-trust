<?php

/**
 * Copykitten coopère tant que vous coopérez ou ne trichez pas deux fois de suite.
 * Il ne triche donc que si l'adversaire vient de tricher deux fois de suite.
 */
class Copykitten extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		if (count($this->match->rounds) < 2) {
			return true;
		}
		$other_player_number = self::otherPlayerNumber($this->number);
		$last_round          = end($this->match->rounds);
		$before_last_round   = prev($this->match->rounds);
		return
			$before_last_round->player_put_coin[$other_player_number]
			|| $last_round->player_put_coin[$other_player_number];
	}

}
