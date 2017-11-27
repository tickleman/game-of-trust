<?php

/**
 * La décision est laissée à l'humain devant son clavier : 1 ou mettre une pièce, 0 pour non
 */
class Human extends Player
{

	/**
	 * @return boolean
	 */
	public function decides(): bool
	{
		do {
			echo 'Tour ' . $this->match->current_round_number() . ", joueur $this->number : ";
			$decision = readline('Votre décision ? 1 pour mettre une pièce, 0 pour ne pas en donner > ');
		}
		while (!in_array($decision, ['0', '1']));
		return boolval($decision);
	}

}
