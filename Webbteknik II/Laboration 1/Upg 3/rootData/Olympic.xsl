<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:svg="http://www.w3.org/2000/svg" >
    <xsl:output indent="yes" method="xml" />
    
    <xsl:param name="query" />
    <xsl:variable name="svg" select="'svg'" />
    <xsl:variable name="xhtml" select="'xhtml'" />
    <xsl:variable name="xhtml_svg" select="'xhtml_svg'" />
	
    <xsl:template match="/">
    	<html>
    		<head><title>Olympic</title></head>
    		<body>
    			<xsl:if test="$query = $xhtml">
    				<p><xsl:value-of select="result/@event" /><xsl:text> - </xsl:text><xsl:value-of select="result//country/text()" /><xsl:text>, </xsl:text><xsl:value-of select="result//city/text()" /></p>
    				<table>
						<thead style="background-color: gray;">
							<tr>
								<th>
									Country
								</th>
								<th>
									Gold
								</th>
								<th>
									Silver
								</th>
								<th>
									Bronze
								</th>
							</tr>
						</thead>
						<tbody>
							<xsl:for-each select="result//country">	
								<tr>
									<td>
										<xsl:value-of select="@name" />
									</td>
									<td>
										<xsl:value-of select="gold" />
									</td>
									<td>
										<xsl:value-of select="silver" />
									</td>
									<td>
										<xsl:value-of select="bronze" />
									</td>
								</tr>
							</xsl:for-each>
						</tbody>
					</table>
				</xsl:if>
				
    			<xsl:if test="$query = $svg">
    				
    				<table>
						<xsl:for-each select="result//country">	
							<xsl:variable name="gold" select="gold" />
							<tr>
								<td>
									<xsl:value-of select="@name" />
								</td>
								<td>
									<svg version="1.1">
								    	<rect width="14" height="20" style="fill:yellow; "/>
									</svg>
								</td>
								<td>
									<xsl:value-of select="gold" />
								</td>
							</tr>
						</xsl:for-each>
					</table>
				</xsl:if>

				<xsl:if test="$query = $xhtml_svg">
					
					<!--Alla-->
				</xsl:if>
    		</body>
    	</html>
    </xsl:template>
</xsl:stylesheet>