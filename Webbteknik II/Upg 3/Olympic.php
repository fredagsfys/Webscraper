<?php
	$query = array (0=>"xhtml", 1=>"svg", 2=>"xhtml_svg");
	
	$xml = new DOMDocument();
	$xml->load("rootData/os_resultat.xml");
	
	$xsl = new DOMDocument();
	$xsl->load("rootData/Olympic.xsl");
	
	
	$proc = new XSLTProcessor();
	$proc->importStylesheet($xsl);
	
	if(isset($_GET['svg']))
	{
		$proc->setParameter("", 'query', $query[1]);
	}
	else if(isset($_GET['xhtml']))
	{
		$proc->setParameter("", 'query', $query[0]);
	}
	else if(isset($_GET['xhtml_svg']))
	{
		$proc->setParameter("", 'query', $query[2]);
	}
	echo $proc->transformToXML($xml);

	
	
	