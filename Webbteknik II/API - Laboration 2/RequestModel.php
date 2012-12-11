<?php

/*
 * RequestModel class takes care of all logics and database interactions.
 * Select, Insert, Update, Delete
 */
class RequestModel {

	/*
	 * This method gets all producers from db
	 * and returns it.
	 */
	public function GetAll($connection) {
		$q = "SELECT * FROM Producers";

		$stmt = $connection -> prepare($q);
		if (!$stmt -> execute()) {
			return false;
		}
		$result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	/*
	 * This method gets a specific producer from db
	 * and returns it.
	 */
	public function GetSpec($connection, $id) {
		$q = "SELECT * FROM Producers WHERE ProducerID = :ProducerID";

		$stmt = $connection -> prepare($q);
		$stmt -> bindParam(":ProducerID", $id);

		if (!$stmt -> execute()) {
			return false;
		}

		$result = $stmt -> fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	/*
	 * This method gets all positions from db
	 * and returns it.
	 */
	public function GetPos($connection) {
		$q = "SELECT  ProducerID, Latitude, Longitude FROM Producers";

		$stmt = $connection -> prepare($q);

		if (!$stmt -> execute()) {
			return false;
		}
		$result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	/*
	 * This method gets a specific position from db
	 * and returns it.
	 */
	public function GetSpecPos($connection, $id) {
		$q = "SELECT ProducerID, Latitude, Longitude FROM Producers WHERE ProducerID = :ProducerID";

		$stmt = $connection -> prepare($q);
		$stmt -> bindParam(":ProducerID", $id);
		if (!$stmt -> execute()) {
			return false;
		}

		$result = $stmt -> fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	/*
	 * This method takes input data from client and stores it in db,
	 * also returns true/false depending if its successful.
	 */
	public function SaveProd($connection, $producers) {
		
		$producers[7] = floatval($producers[7]);
		$producers[8] = floatval($producers[8]);
		$producers[4] = intval($producers[4]);
		$producers[2] = intval($producers[2]);

		$query = "INSERT INTO Producers 
				(Name, Address, Postalcode, City, Id, Site, Image, Latitude, Longitude) 
				VALUES (
				'$producers[0]',
				'$producers[1]', 
				$producers[2], 
				'$producers[3]', 
				$producers[4], 
				'$producers[5]', 
				'$producers[6]',
				$producers[7],
				$producers[8])";
		if (!$connection -> query($query)) {
			return false;
		}
		return true;
	}

	/*
	 * This method takes care of deletion by getting
	 * the id from client. Returns true/false.
	 */
	public function DeleteProd($connection, $id) {
		$query = "DELETE FROM Producers WHERE ProducerID = :ProducerID";
		$stmt = $connection -> prepare($query);

		$stmt -> bindParam(":ProducerID", $id);

		if (!$stmt -> execute()) {
			return false;
		}
		return true;
	}

	/*
	 * This method takes care of the update. Checks if
	 * any input is null and calls GetSpec method to fill it with
	 * earlier data.
	 */
	public function UpdateProd($connection, $id, $values) {

		$prod = $this -> GetSpec($connection, $id);
		if ($values['Name'] == null) {
			$values['Name'] = $prod['Name'];
		}

		if ($values['Address'] == null) {
			$values['Address'] = $prod['Address'];
		}

		if ($values['Postalcode'] == null) {
			$values['Postalcode'] = $prod['Postalcode'];
		}

		if ($values['City'] == null) {
			$values['City'] = $prod['City'];
		}

		if ($values['Id'] == null) {
			$values['Id'] = $prod['Id'];
		}

		if ($values['Site'] == null) {
			$values['Site'] = $prod['Site'];
		}

		if ($values['Image'] == null) {
			$values['Image'] = $prod['Image'];
		}

		if ($values['Latitude'] == null) {
			$values['Latitude'] = $prod['Latitude'];
		}

		if ($values['Longitude'] == null) {
			$values['Longitude'] = $prod['Longitude'];
		}

		$query = "UPDATE Producers SET  Name = :Name, Address = :Address, Postalcode = :Postalcode, City = :City, Id = :Id, Site = :Site, Image = :Image, Latitude = :Latitude, Longitude = :Longitude WHERE ProducerID = :ProducerID";
		$stmt = $connection -> prepare($query);

		$stmt -> bindParam(":Name", $values['Name'], PDO::PARAM_STR, 20);

		$stmt -> bindParam(":Address", $values['Address'], PDO::PARAM_STR, 20);

		$stmt -> bindParam(":Postalcode", $values['Postalcode'], PDO::PARAM_INT);

		$stmt -> bindParam(":City", $values['City'], PDO::PARAM_STR, 20);

		$stmt -> bindParam(":Id", $values['Id'], PDO::PARAM_INT);

		$stmt -> bindParam(":Site", $values['Site'], PDO::PARAM_STR, 20);

		$stmt -> bindParam(":Image", $values['Image'], PDO::PARAM_STR, 20);

		$stmt -> bindParam(":Latitude", $values['Latitude'], PDO::PARAM_STR, 20);

		$stmt -> bindParam(":Longitude", $values['Longitude'], PDO::PARAM_STR, 20);

		$stmt -> bindParam(":ProducerID", $id, PDO::PARAM_INT);

		if (!$stmt -> execute()) {
			return false;
		}

		if ($stmt -> rowCount() < 1) {

			return false;
		}
		return true;
	}

}
