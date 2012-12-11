<?php
require_once 'RequestView.php';
require_once 'RequestError.php';
require_once 'RequestModel.php';

/*
 * This class takes care of which methods to call depending
 * on client interactions.
 */
class RequestController {
	/*
	 * This method calls diffrent methods depending on which url it gets from the client.
	 * It uses a switch to decide proper case.
	 *
	 * This method also checks if something goes wrong such as wrong parameters or server errors.
	 * If so it calls the RequestError which returns an error message for the client.
	 */
	public function doControll($connection, $value = null, $parameters = null) {
		$reqViw = new RequestView();
		$reqErr = new RequestError();
		$reqModel = new RequestModel();

		$url = $reqViw -> GetURL();

		switch ($url) {
			case 'producers' :
				if ($reqModel -> GetAll($connection) == FALSE) {
					$result = $reqErr -> DoError(500);
				} else {
					$result = $reqModel -> GetAll($connection);
				}
				break;

			case 'producers/id' :
				if ($reqModel -> GetSpec($connection, $value) == FALSE) {
					$result = $reqErr -> DoError(404);
				} else {
					$result = $reqModel -> GetSpec($connection, $value);
				}
				break;

			case 'producers' :
				if ($value == FALSE) {
					$result = $reqErr -> DoError(500);
				} else {
					$result = $reqModel -> SaveProd($connection, $value);
				}
				break;

			case '/producers/id' :
				if ($reqModel -> DeleteProd($connection, $value) == FALSE) {
					$result = $reqErr -> DoError(404);
				} else {
					$result = $reqModel -> DeleteProd($connection, $value);
				}
				break;

			case '/producers/id' :
				if ($reqModel -> UpdateProd($connection, $value, $parameters) == FALSE) {
					$result = $reqErr -> DoError(404);
				} else {
					$result = $reqModel -> UpdateProd($connection, $value, $parameters);
				}
				break;

			case '/producers/positions' :
				if ($reqModel -> GetPos($connection) == FALSE) {
					$result = $reqErr -> DoError(500);
				} else {
					$result = $reqModel -> GetPos($connection);
				}
				break;

			case '/producers/id/position' :
				if ($reqModel -> GetSpecPos($connection, $value) == FALSE) {
					$result = $reqErr -> DoError(404);
				} else {
					$result = $reqModel -> GetSpecPos($connection, $value);
				}
				break;

			default :
				$result = "vaelkommen till detta API (>_<)\m/!";
				break;
		}
		return $reqViw -> doOutputXML($result);
	}

}
