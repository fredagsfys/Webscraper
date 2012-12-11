<?php

$xsl = new DOMDocument();
$xsl->load("Producents.xsl");

$doc = new DOMDocument();

$proc = new XsltProcessor();
$proc->importStylesheet($xsl);

echo $proc->transformToXml($doc);
	
	