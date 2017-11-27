<?php

/**
 * Classe technique : charge automatiquement la classe dont on a besoin
 */
class Autoloader
{

	/**
	 * @param string $class_name
	 * @return boolean
	 */
	public function autoload($class_name)
	{
		if (file_exists("$class_name.php")) {
			return include_once "$class_name.php";
		}
		else {
			foreach (scandir('.') as $directory) if (file_exists("$directory/$class_name.php")) {
				return include_once "$directory/$class_name.php";
			}
		}
		return false;
	}

}

spl_autoload_register([new Autoloader, 'autoload']);
