<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
	xmlns:xh="http://www.w3.org/xhtml"
	xmlns:php="http://php.net/xsl"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" />

  	<xsl:template match="/">
		<xsl:apply-templates />
	</xsl:template>
	
	
	<xsl:template match="rss">
	<xsl:for-each select="channel">

	<!-- Start Rss Body -->
	<xsl:for-each select="item">
	<div>
		<span><strong><xsl:value-of select="title" disable-output-escaping="yes" /></strong></span>
		<p><xsl:value-of select="php:function('Utils::cutAndCleanDescription', string(description))" /></p>
	</div>
	</xsl:for-each>
	<!-- End Rss Body -->

	</xsl:for-each>
	</xsl:template>
	
	<xsl:template match="rss/*" priority="-1" />
	
</xsl:stylesheet>
