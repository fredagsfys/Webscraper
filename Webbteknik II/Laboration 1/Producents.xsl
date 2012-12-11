<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"  >			
	<xsl:output method="xml" version="1.0" encoding="UTF-8" indent="yes" />	
				<!--Anger vilka filer som ska hämtas-->
	<xsl:param name="source-producenter" select="'Producers.xml'"/>	
	<xsl:param name="source-positioner" select="'positioner.xml'"/>
	<xsl:variable name="producenter" select="document($source-producenter)"/>
  	<xsl:variable name="Workbook" select="document($source-positioner)"/>

    <xsl:template match="/">
    	<table>
				<thead style="background-color: gray;">
					<tr>
						<th>
							Id
						</th>
						<th>
							Name
						</th>
						<th>
							Address
						</th>
						<th>
							Postalcode
						</th>
						<th>
							City
						</th>
						<th>
							Site
						</th>
						<th>
							Image
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
	    	<Producers>
				<xsl:for-each select="$producenter//producer">	
					<tr>
					<producer>
						<td>
							<id><xsl:value-of select="id" /></id>
						</td>
						<td>
							<name><xsl:value-of select="name" /></name>
						</td>
						<td>
							<address><xsl:value-of select="address" /></address>
						</td>
						<td>
							<postalcode><xsl:value-of select="postalcode" /></postalcode>
						</td>
						<td>
							<city><xsl:value-of select="city" /></city>	
						</td>
						<td>
							<site><xsl:value-of select="site" /></site>
						</td>
						<td>
							<img><xsl:value-of select="img" /></img>
						</td>
						 <!--Store id from producent into storeId xsl variable -->
						<xsl:variable name="storedId" select="id" />
						<!--Using filter to get correct Cells for latitude and longitude and checks if text() in number is equal to our storedId variable-->
						<xsl:variable name="selected" select="$Workbook//ss:Cell[@ss:Index='2']/ss:Data[@ss:Type='Number' and text() = $storedId]" />						
						<!--Gets the filtered values-->
						<td>
						<latitude><xsl:value-of select="$selected//../../ss:Cell[2]/ss:Data" /></latitude>
						</td>
						<td>
						<longitude><xsl:value-of select="$selected//../../ss:Cell[3]/ss:Data" /></longitude>
						</td>
					</producer>
					</tr>
				</xsl:for-each>
			</Producers>
			</tbody>
		</table>
    </xsl:template>
</xsl:stylesheet>