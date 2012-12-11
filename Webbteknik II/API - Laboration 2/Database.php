<?php

/*
 * This class takes care of the connection
 * to the database.
 */
class Database {
	/*
	 * This method creates an connection to the sqlite database.
	 */
	public function Connect() {
		try {
			$database = new PDO("sqlite:ProducersDB.sqlite");
			$database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $ex) {
			die("ERROR!" . $ex -> getMessage());
		}
		return $database;
	}

}
