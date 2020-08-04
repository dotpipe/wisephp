<?xml-stylesheet type="text/xml" version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html"/>
	<xsl:template match="/">
		<style>
	#td-surround { background:white;border:0px;width:250px; }
	#texter { background:white;height:30px;width:250px; }
	#flag { background:white;height:20px;width:20px;cursor:pointer; }
	#inputs { font-size:24px;border:2px solid darkblue;width:250px; }
	#in-window { display:grid;grid-template-columns: 60px 175px 35px;border:2px solid darkblue;overflow-wrap:break-word;overflow-y:scroll;color:black;background:white;height:300px;width:250px; }
	.tooltip { position: relative; display: inline-block; }

	/* Tooltip text */
	.tooltip .tooltiptext { margin-left: 20%; visibility: hidden; width: 120px; background-color: white;
		color: #000; text-align: center; padding: 5px 0; border-radius: 6px;
		/* Position the tooltip text - see examples below! */
        position: absolute; z-index: 3; }
        
	.tooltip .tooltiptext { top: 0px; right: 140%; }
	
	/* Show the tooltip text when you mouse over the tooltip container */
	.tooltip:hover .tooltiptext { visibility: visible; }
	.tooltip .tooltiptext::after { content: " "; position: absolute; top: 50%; left: 100%; /* To the right of the tooltip */
		margin-top: -7px; border-width: 5px;
        border-style: solid; border-color: transparent transparent transparent white; }
   </style>
		<table style="position:fixed;height:50%">
			<tr>
				<td>
					<b style="font-size:15px;color:red">
						<xsl:text>Chat with </xsl:text>
						<xsl:value-of select="//messages/msg/@alias"/>
					</b>
					<xsl:text> : : </xsl:text>
				</td>
			</tr>
			<tr>
				<td id="td-surround">
					<div id="in-window">
						<xsl:for-each select="messages/msg">
							<p>
								<div class="tooltip flag" time="{text/@time}" alias="{text/@alias}" style="grid-area: auto / 1;height:10px;font-size:12px;background:white;color:black;width:100%">
									<xsl:value-of select="text/@alias"/>
								</div>
								<div class="msg_text" style="grid-area: auto / 2;">
									<xsl:value-of select="text"/>
								</div>
								
								<div id="flag" style="grid-area: auto / 3;" onclick="this.className='tooltip';toggleFlagComment(this);">
									҉
									<span class="tooltiptext" style="display:none" onclick="flagComment(this)">Flag Comment</span>
								</div>
							</p>
						</xsl:for-each>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div id="texter">
						<input spellcheck="true" onkeypress="goChat(this,event.keyCode)" id="inputs" type="text"/>
					</div>
				</td>
			</tr>
		</table>
	</xsl:template>
</xsl:stylesheet>
