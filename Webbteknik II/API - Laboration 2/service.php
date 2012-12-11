<?php
require_once 'RequestController.php';
require_once 'RequestView.php';
require_once 'RequestError.php';
require_once 'RequestModel.php';
require_once 'APIKeys.php';
require_once 'Database.php';

/*
 * This class takes care of all requests
 * to the server, depending wether it's
 * a GET, POST, DELETE, PUT.
 */
class Service {

	/*
	 * Variabels
	 */
	private static $post = 'post';
	private static $delete = 'delete';
	private static $get = 'get';
	private static $put = 'put';
	private static $input = 'php://input';
	private static $prodID = 'ProducerID';

	/*
	 * Main method which takes care of the request from the client.
	 * Also calls the proper class and method to retrive/add data.
	 */
	public static function Main() {
		$db = new Database();
		$reqViw = new RequestView();
		$reqErr = new RequestError();
		$reqModel = new RequestModel();
		$apiKeys = new APIKeys();

		$connection = $db -> Connect();

		$method = $reqViw -> GetReqMethod();
		if ($reqViw -> GetProdString() != NULL) {

			if ($method == self::$post) {
				if ($reqViw -> GetProdID() == NULL) {
					$prodArr = $reqViw -> GetProd();
					$body = $reqModel -> SaveProd($connection, $prodArr);
					if($body) {
						$body =$reqErr -> DoError(201);
					}
				}
			} else if ($method == self::$delete) {
				if ($reqViw -> GetProdID() != NULL) {
					$body = $reqModel -> DeleteProd($connection, $reqViw -> GetProdID());
						if($body) {
						$body = $reqErr -> DoError(200);
					}
				}
			} else if ($method == self::$get) {

				if ($reqViw -> GetProdID() != NULL && $reqViw -> GetPos() == NULL) {
					$body = $reqModel -> GetSpec($connection, $reqViw -> GetProdID());
				} else if ($reqViw -> GetProdID() != NULL && $reqViw -> GetPos() != NULL) {
					$body = $reqModel -> GetSpecPos($connection, $reqViw -> GetProdID());
				} else if ($reqViw -> GetProdID() == NULL && $reqViw -> GetPos() != NULL) {
					$body = $reqModel -> GetPos($connection);
				} else if ($reqViw -> GetProdID() == NULL && $reqViw -> GetPos() == NULL) {
					$body = $reqModel -> GetAll($connection);
				}

			} else if ($method == self::$put) {
				$values = file_get_contents('php://input');
				parse_str($values, $parsedVlu);
				foreach ($parsedVlu as $field => $value) {
					$parameters[$field] = $value;
				}
				$body = $reqModel -> UpdateProd($connection, $reqViw -> GetProdID(), $parameters);
					if($body) {
						$body =$reqErr -> DoError(200);
					}
			}

		} else {
			$reqErr -> DoError(404);
		}
		if ($body == false) {
			$reqErr -> DoError(404);
		} else if ($body) {
			return $reqViw -> doOutputXML($body);
		} else {
			$reqErr -> DoError(500);
		}

	}

}

echo Service::Main();
