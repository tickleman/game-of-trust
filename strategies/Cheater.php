<?php

/**
 * Cheater ne donne jamais de pièce, quoi qu'il se soit passé durant le match en cours
 */
class Cheater extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		return false;
	}

}
