<?php

$xsl = new DOMDocument();
$xsl->load("Producents.xsl");

$doc = new DOMDocument();

$proc = new XSLTProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXml($doc);
	
	