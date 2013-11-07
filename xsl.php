<?php 

// send out the mime type for firefox
header('content-type: text/xml');

// send the opening header via an echo statement (leaving it as text confuses php if short-tags are enabled)
echo '<' . '?xml version="1.0" ?'.'>'; 

?> 

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	
	
	<xsl:output method="html"/>

	<xsl:template match="/">
	
		<html>
			<head>
				<title>
					<xsl:value-of select="rss/channel/title" />
				</title>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
				<script type="text/javascript" src="scripts.js"></script>
				<link rel="stylesheet" title="text/css" href="theme/style.css" />
			</head>
			<body>
				<div id="page-wrap">
					<div id="header-wrap">
						<div id="header">
							<div id="logo">
								<h1>
									<a>
										<xsl:attribute name="href">
											<xsl:value-of select="rss/channel/link" />
										</xsl:attribute>
										<xsl:value-of select="rss/channel/title" />
									</a>
								</h1>
								<p>Via Nathan Friedly's RSS Reader</p>
							</div>
							 <div id="search">
								 <form action="?" method="get">
									 <input name="url" class="field" type="text" value="<?=(isset($_REQUEST['url']))?$_REQUEST['url'] : ''?>" /><input value="Read" class="button" type="submit" />
								 </form>
							 </div>
						</div>
					</div>
					
					<div id="content">
						<xsl:apply-templates/>
					</div>
								
					<div id="sidebar">
						<div id="ads">
							<div class="title">
								<h3>Index</h3>
							</div>
							<div class="wrapper">
								<div class="content">
									<ul>
										<xsl:for-each select="rss/channel/item">
											<li>
												<a>
													<xsl:attribute name="href">#<xsl:number/></xsl:attribute>
													<xsl:value-of select="title"/>
												</a>
											</li>										
										</xsl:for-each>
									</ul>
								</div>
							</div>
						</div>
	
						<div id="left">
				
							<div class="title">
								<h3>Suggested Feeds</h3>
							</div>
							<div class="wrapper">
								<div class="content">
									<ul>
										<li><a href="?url=http://nfriedly.com/techblog/feed/">nFriedly Web Dev Techblog</a></li>
										<li><a href="?url=http://feeds.gawker.com/lifehacker/full">Lifehacker</a></li>
										<li><a href="?url=http://www.aaronsw.com/2002/feeds/pgessays.rss">Paul Grahm: Essays</a></li>
										<li><a href="?url=http://hackadaycom.wordpress.com/feed/">Hack a Day</a></li>
									</ul>
								</div>
							</div>

						</div>
	
						<div id="right">

							<div class="title">
								<h3>Other Links</h3>
							</div>
							<div class="wrapper">
								<div class="content">
									 <ul>
										<li><a href="?">Home</a></li>
										<li><a href="http://nfriedly.com">Nathan Friedly</a></li>
										<li><a href="http://nfriedly.com/webdev/">Web Development</a></li>
									</ul>
								</div>
							</div>
		
						</div>
					</div>
					
					<div id="footer-wrap">
						<div id="footer">
							<p>Theme based on Purple Swirl by <a href="http://www.ceneb.com/">Ceneb</a>. 
							RSS research and templiate additon by <a href="http://nfriedly.com">Nathan Friedly</a> - <a href="http://nfriedly.com/webdev">RSS Programing &amp; Development</a>
							
							<!-- for UC's IT 322 Data Representation Technology class. (A fancy and ambigious way of saying "XML.") --></p>
						</div>
					</div>
				</div>
			</body>
		</html>
	</xsl:template>
	
	<xsl:template match="text()">
		<!-- This hides all the extra junk that we don't want -->
	</xsl:template>	
	
	
 	<xsl:template match="item">
		
    	<div class="post">
    		<div class="title">
      		  	<h3>
					<a>
						<xsl:attribute name="name">
							<xsl:number/>
						</xsl:attribute>						
						<xsl:attribute name="href">
							<xsl:value-of select="./link" />
						</xsl:attribute>
						<xsl:value-of select="./title" />
					</a>
				</h3>
       		 </div>
      		<div class="post-wrap">
        		<div class="content">
					<xsl:if test="./pubDate">
						<div class="info">
							<!-- div class="gravatar"><img alt="" src="" class="avatar avatar-50" width="50" height="50"></div -->                		<div class="content">
								<!-- p class="author">Author: <b><xsl:value-of select="./dc:creator"/></b></p -->
								<p class="author">
									Link: 
									<b>
										<a>					
											<xsl:attribute name="href">
												<xsl:value-of select="./link" />
											</xsl:attribute>
											<xsl:value-of select="./link" />
										</a>
									</b>
								</p>
								<br />
								<p class="date">Posted on: <b><xsl:value-of select="./pubDate"/></b></p>
							</div>
						</div>
					</xsl:if>
             		<div class="post-content">
						<xsl:choose>
							<xsl:when test="./description">
        						<xsl:value-of select="./description"/>
							</xsl:when>
							<xsl:otherwise>
								<p>
									Read it at <a>					
										<xsl:attribute name="href">
											<xsl:value-of select="./link" />
										</xsl:attribute>
										<xsl:value-of select="./link" />
									</a>
								</p>
							</xsl:otherwise>
						</xsl:choose>
          			</div>
       			</div>
    		</div>
    	</div>
		
	</xsl:template>

	


</xsl:stylesheet>