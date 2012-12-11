<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
				<!--Anger vilka filer som ska hämtas-->
	<xsl:param name="source-producenter" select="'Producents.xml'"/>	
	<xsl:param name="source-positioner" select="'positioner.xml'"/>
	<xsl:variable name="producenter" select="document($source-producenter)"/>
  	<xsl:variable name="Workbook" select="document($source-positioner)"/>
  	
    <xsl:template match="/">
    	
    	<html style="background-color:black;color:white;">
    		<head><title>XSLT</title></head>
    		<body>

    			<table>
					<thead>
						<tr>
							<th>
								Id
							</th>
							<th>
								Namn
							</th>
							<th>
								Adress
							</th>
							<th>
								Postnr
							</th>
							<th>
								Ort
							</th>
							<th>
								Hemsida
							</th>
							<th>
								Logo
							</th>
							<th>
								latitude
							</th>
							<th>
								longitude
							</th>
						</tr>
					</thead>
					<tbody>
						<xsl:for-each select="$producenter//producent">	
							<tr>
								<td>
									<xsl:value-of select="id" />
								</td>
					
								<td>
									<xsl:value-of select="name" />
								</td>
								<td>
									<xsl:value-of select="adress" />
								</td>
								<td>
									<xsl:value-of select="postnummer" />
								</td>
								<td>
									<xsl:value-of select="ort" />
								</td>
								<td>
									<xsl:value-of select="site" />
								</td>
								<td>
									<xsl:value-of select="img" />
								</td>
			
								<!--Store id from producent into storeId xsl variable -->
								<xsl:variable name="storedId" select="id" />
								<!--Using filter to get correct Cells for latitude and longitude and checks if text() in number is equal to our storedId variable-->
								<xsl:variable name="selected" select="$Workbook//ss:Cell[@ss:Index='2']/ss:Data[@ss:Type='Number' and text() = $storedId]" />						
								<!--Gets the filtered values-->
								<td><xsl:value-of select="$selected//../../ss:Cell[2]/ss:Data" /></td>
								<td><xsl:value-of select="$selected//../../ss:Cell[3]/ss:Data" /></td>
							</tr>
						</xsl:for-each>
					</tbody>
				</table>		
    		</body>
    	</html>
    </xsl:template>
</xsl:stylesheet>