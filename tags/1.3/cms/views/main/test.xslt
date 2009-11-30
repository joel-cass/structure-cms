<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	<xsl:template match="content">
		<h4>This is a test</h4>
		<xsl:for-each select="fields/field">
			<xsl:call-template name="showField" />
		</xsl:for-each>
	</xsl:template>
	
	
	<xsl:template name="showField">
		<strong>
			<xsl:value-of select="@name" />: 
		</strong>
		<xsl:value-of select="text()" />
		<br/>
	</xsl:template>
	
</xsl:stylesheet>