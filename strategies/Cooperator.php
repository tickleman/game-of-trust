<?php

/**
 * Cooperator donne tout le temps une pièce, quoi qu'il se soit passé durant le match en cours
 */
class Cooperator extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		return true;
	}

}
