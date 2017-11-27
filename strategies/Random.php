<?php

/**
 * Random joue totalement au hasard : il met une pièce, ou pas, c'est 50/50
 */
class Random extends Player
{

	/**
	 * @return boolean
	 */
	public function decides() : bool
	{
		return boolval(rand(0, 1));
	}

}
