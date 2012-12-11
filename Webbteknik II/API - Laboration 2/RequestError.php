<?php
/*
 * This class takes care of the error messages.
 */
class RequestError {
	/*
	 * This method uses a switch to decide which
	 * error should be presented for the client.
	 */
	public function DoError($error) {
		switch ($error) {
			case '404' :
				$err = header('HTTP/1.1 404 Bad Request');
				$err .= header('Content-Type: application/json');
				$err .= "<error>Producer not found</error>";
				return $err;
			case '500' :
				$err = header('HTTP/1.1 500 Internal Server Error');
				$err .= header('Content-Type: application/json');
				$err .= "<error>Database execution error</error>";
				return $err;
			case '201' :
				$err = header('HTTP/1.1 201 Created');
				$err .= header('Content-Type: application/json');
				$err .= "<message>Success!</message>";
				return $err;
			case '200' :
				$err = header('HTTP/1.1 200 Ok');
				$err .= header('Content-Type: application/json');
				$err .= "<message>Ok!</message>";
				return $err;
			
		}
	}

}
