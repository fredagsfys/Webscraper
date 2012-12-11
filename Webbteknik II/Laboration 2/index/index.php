<?php

	$database;
	$i = 0;
	try{
		$database = new PDO('sqlite:ProducersDB.sqlite');
		$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	}
	catch(PDOException $e)
	{
		die('Fail --->' . $e->getMessage());	
	}
			
	$query = 'CREATE TABLE Producers (ProducerID INTEGER PRIMARY KEY, Name TEXT, Address TEXT, Postalcode INTEGER, City TEXT, Id INTEGER, Site TEXT, Image TEXT, Latitude FLOAT, Longitude FLOAT)';
	
	try{
		$sth = $database->prepare($query);
		if(!$sth->execute()) {
			die("Fel, gick ej skapa tabell");
		}
		else{
			echo 'Table was created successfully!<br /><br />';
		}
	}
	catch(PDOException $e)
	{
		die('FEL!! -->' . $e->getMessage());
	}
	
	$url = 'ProducersExt.xml';
	$xml = simplexml_load_file($url);

	foreach($xml as $producers)
	{
		$latitude = floatval($producers->latitude);
		$longitude = floatval($producers->longitude);
		$query = "INSERT INTO Producers 
				(Name, Address, Postalcode, City, Id, Site, Image, Latitude, Longitude) 
				VALUES (
				'$producers->name', 
				'$producers->address', 
				'$producers->postalcode', 
				'$producers->city', 
				'$producers->id', 
				'$producers->site', 
				'$producers->img',
				 $latitude,
				 $longitude)";
		if(!$database->query($query)){
			die("Fel vid insert");
		}
		else{
			echo "XML data row ['$i'] was inserted successfully from $url! <br />";
			$i++;
		}	
	}
	echo "<br/><b>Complete! Database is fully created and populated with data from '$url'</b>";
	
	