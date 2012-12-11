<?php
/*
 * This class hold the API-KEYS provided to use the Producer API
 */
	class APIKeys
	{
		/*
		 * Variabels/Keys
		 */
		private static $key1 = '501ssr456g';
		private static $key2 = '604sgr036f';
		private static $key3 = '305osr129s';
		
		/*
		 * This method returns if inputted key exists or not
		 */
		public function Keys($key)
		{
			if($key == self::$key1)
			{
				return true;
			}
			return false;
		}
	}
