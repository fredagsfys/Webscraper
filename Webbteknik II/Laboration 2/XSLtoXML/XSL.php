<?php

$xsl = new DOMDocument();
$xsl->load(".././rootData/Producents.xsl");

$doc = new DOMDocument();

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

$result = $proc->transformToXML($doc);

$myFile = ".././index/ProducersExt.xml";

$fh = fopen($myFile, 'w') or die("can't open file");

fwrite($fh, $result);

fclose($fh);

echo "ProducersExt.xml was successfully created in " . $myFile;
