<?php

/**
 * Grudger coopère jusqu'à ce que l'autre joueur triche. Alors il triche jusqu'à la fin
 */
class Grudger extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		return $this->otherPlayerHasCheated()
			? false
			: true;
	}

}
