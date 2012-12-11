<?php

/*
 * RequestView class takes care of the visual part for a client.
 * Depending on client interactions on the site, RequestView provides diffrent visualities.
 */
class RequestView {
	/*
	 * Variabels
	 */
	private $reqMethod = 'REQUEST_METHOD';
	private $name = 'Name';
	private $address = 'Address';
	private $postalCode = 'Postalcode';
	private $city = 'City';
	private $id = 'Id';
	private $site = 'Site';
	private $img = 'Image';
	private $lat = 'Latitude';
	private $long = 'Longitude';
	private $prodID = 'ProducerID';
	private $apikey = 'api-key';

	public function GetURL() {
		return basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	}

	/*
	 * This method encodes data to JSON
	 */
	public function doOutputXML($data) {
		return json_encode($data, JSON_PRETTY_PRINT);
	}

	/*
	 * This method gets the POST info and pushes it into an array
	 */
	public function GetProd() {
		if (isset($_POST[$this -> name]) && isset($_POST[$this -> address]) && isset($_POST[$this -> postalCode]) && isset($_POST[$this -> city]) && isset($_POST[$this -> id]) && isset($_POST[$this -> site]) && isset($_POST[$this -> img]) && isset($_POST[$this -> lat]) && isset($_POST[$this -> long])) {
				
			$prodArr = array();
			array_push($prodArr, $_POST[$this -> name], $_POST[$this -> address], $_POST[$this -> postalCode], $_POST[$this -> city], $_POST[$this -> id], $_POST[$this -> site], $_POST[$this -> img], $_POST[$this -> lat], $_POST[$this -> long]);
			
			return $prodArr;
		}
		else {
			return false;
		}	
	}

	/*
	 * This method checks if ProductID is set
	 */
	public function TriedToGetProd() {
		if (isset($_GET[$this -> prodID])) {
			return true;
		}
		return false;
	}

	/*
	 * This method returns ProductID without check
	 */
	public function GetProdID() {
		$ret = explode('/', $_SERVER['PATH_INFO']);
		return $ret[2];
	}
	
	public function GetPos() {
		$ret = explode('/', $_SERVER['PATH_INFO']);
		if($ret[3] == 'positions')
		{
			return $ret[3];
		}
		return null;	
	}
	
	public function GetProdString() {
		$ret = explode('/', $_SERVER['PATH_INFO']);
		if($ret[1] == 'producers')
		{
			return $ret[1];
		}
		return null;	
	}

	/*
	 * Returns the requested method, PUT, GET POST, DELETE
	 */
	public function GetReqMethod() {
		return strtolower($_SERVER[$this -> reqMethod]);
	}
	
	/*
	 * 
	 */
	public function GetAPIKey()
	{
		return $_GET[$this -> apikey];
	}

}
