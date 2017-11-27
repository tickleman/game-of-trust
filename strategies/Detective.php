<?php

/**
 * Les 4 premiers tours du Detective sont toujours : collabore, triche, collabore, collabore
 * Ensuite :
 * - si l'autre joueur a toujours collaboré, il triche jusqu'à la fin
 * - si l'autre joueur a triché au moins une fois, il joue au donnant-donnant, comme copycat
 */
class Detective extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		// les 4 premiers tours sont toujours les mêmes :
		switch ($this->match->current_round_number()) {
			case 1: return true;
			case 2: return false;
			case 3: return true;
			case 4: return true;
		}
		// pour les suivants, ça dépend
		return $this->otherPlayerHasCheated()
			? $this->decidesLikeA(Copycat::class)
			: $this->decidesLikeA(Cheater::class);
	}

}
