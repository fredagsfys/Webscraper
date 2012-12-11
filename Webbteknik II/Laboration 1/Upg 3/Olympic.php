<?php
	$query = array (0=>"xhtml", 1=>"svg", 2=>"xhtml_svg");
	
	$xml = new DOMDocument();
	$xml->load("rootData/os_resultat.xml");
	
	$xsl = new DOMDocument();
	$xsl->load("rootData/Olympic.xsl");
	
	
	$proc = new XSLTProcessor();
	$proc->importStylesheet($xsl);

	$proc->setParameter("", 'query', $query[1]);
	echo $proc->transformToXML($xml);

	
	
	