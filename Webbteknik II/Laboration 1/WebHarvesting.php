<?php
include_once 'simple_html_dom.php';

/**
 * Paths to site
 */

$subhtml = 'http://172.16.206.1/~thajo/1DV449/laboration01/producenter/';

/**
 * Creates new XML document using DOMDocument
 * Also creates a new JSON document using fopen, fwrite
 */
$doc = new DOMDocument('1.0', 'utf-8');
$doc -> formatOutput = true;

$json = "Producers.json";
$fileHolder = fopen($json, 'w') or die("can't open file");

//Creates element producents to wrap the whole producent with
$producentsElement = $doc -> createElement("Producers");
$doc -> appendChild($producentsElement);

//Get alot of element by looping and nesting...
foreach ($html->find('td') as $element) {
	foreach ($element->find('a') as $link) {
		$result = file_get_html('http://172.16.206.1/~thajo/1DV449/laboration01/producenter/' . $link -> href);

		$listElement = $doc -> createElement("producer");
		$producentsElement -> appendChild($listElement);

		foreach ($result->find('h1') as $name); {
			$_name = strip_tags($name);
		}
		foreach ($result->find('img') as $img) {
			 $_img = strip_tags($img -> src);
		}
		foreach ($result->find('p') as $p) {
			if ($strong = $p -> find('strong', 0)) {
				if ($strong -> plaintext == 'ADRESS') {
					$innerAdress = $p -> innertext;

					//Adress
					$innerAdress = explode("<br />", $innerAdress);
					$adress = explode("Adress:", $innerAdress[1]);
					$_adress = strip_tags($adress[1]);

					//Postnummer
					$postnummer = explode("Postnummer:", $innerAdress[2]);
					$_postnummer = strip_tags($postnummer[1]);

					//Ort
					$city = explode("Ort:", $innerAdress[3]);
					$stripCity  = strip_tags($city[1]);
					$_city  = trim($stripCity);
				}
				if ($strong -> plaintext == 'KONTAKTINFORMATION') {
					$innerAdress = $p -> innertext;

					//Adress
					$innerAdress = explode("<br />", $innerAdress);
					$website = explode("Hemsida: ", $innerAdress[1]);
					$_website = strip_tags($website[1]);
				
				}
			}
		}
		$id = explode('producent_', $link -> href);
		$id = explode('.html', $id[1]);
		$_id = strip_tags($id[0]);
		
		//
		$nameElement = $doc -> createElement("name", $_name);
		$listElement -> appendChild($nameElement);
		$adressElement = $doc -> createElement("address", $_adress);
		$listElement -> appendChild($adressElement);
		$pnrElement = $doc -> createElement("postalcode", $_postnummer);
		$listElement -> appendChild($pnrElement);
		$cityElement = $doc -> createElement("city", $_city);
		$listElement -> appendChild($cityElement);
		$idElement = $doc -> createElement("id", $_id);
		$listElement -> appendChild($idElement);
		$imgElement = $doc -> createElement("site", $_website);
		$listElement -> appendChild($imgElement);
		$imgElement = $doc -> createElement("img", $_img);
		$listElement -> appendChild($imgElement);
		
		$lol = array( 'name' => $_name, 'adress' => $_adress, 'postnummer' => $_postnummer, 'ort' => $_city, 'id' => $_id, 'img' => $_img );
		$lol1['Producer'] = $lol;
		$lol3[] = $lol1;
	}
}
$lol2['Producers'] = $lol3;
$lol2 = json_encode($lol2, JSON_PRETTY_PRINT);
echo $lol2;


fwrite($fileHolder, $lol2);
fclose($fileHolder);
$doc -> save("Producers.xml");
