<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" >
    <xsl:output indent="yes" method="html" />
    
    <xsl:param name="query" />
    <xsl:variable name="svg" select="'svg'" />
    <xsl:variable name="xhtml" select="'xhtml'" />
    <xsl:variable name="xhtml_svg" select="'xhtml_svg'" />
	
    <xsl:template match="/">
    	<html>
    		<head><title>Olympic</title></head>
    		<body>
    			<xsl:if test="$query = $xhtml or $query = $xhtml_svg">
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
								<xsl:sort select="gold" data-type="number" order="descending"/>
								<xsl:sort select="bronze" data-type="number" order="ascending"/>
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
				
    			<xsl:if test="$query = $svg or $query = $xhtml_svg">
    				<table>
						<xsl:for-each select="//summary/country">
							<xsl:sort select="gold" data-type="number" order="descending"/>
							<xsl:variable name="gold" select="gold" />
							<tr>
								<td>
									<xsl:value-of select="@name" />
								</td>
								<td>
									<svg xmlns="http://www.w3.org/2000/svg" width="{10 * $gold}" height="17">
								    	<rect width="{30 * $gold}" height="20" x="0" y="0" style="fill:yellow;" />
									</svg>
								</td>
								<td>
									<xsl:value-of select="gold" />
								</td>
							</tr>
						</xsl:for-each>
					</table>
				</xsl:if>
    		</body>
    	</html>
    </xsl:template>
</xsl:stylesheet>