<?php header("Content-Type: text/xml");?>
<?php echo "<?xml version=\"1.0\"?>";?>
 
<rdf:RDF
 xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
 xmlns="http://purl.org/rss/1.0/">
 
	<channel rdf:about="http://www.xml.com/xml/news.rss">
		<title><?php LayoutHelper::renderField($PAGE, "Title"); ?></title>
		<link><?php echo $PAGE->getURL(); ?></link>
		<description><?php LayoutHelper::renderField($PAGE, "Description"); ?></description>
		<language><?php LayoutHelper::renderField($PAGE, "Language"); ?></language>
		<pubDate><?php echo Date_Format(date_create(), "D, d F Y H:i:s e") ?></pubDate>
		<lastBuildDate><?php echo Date_Format(date_create(), "D, d F Y H:i:s e") ?></lastBuildDate>
		<generator>Structure CMS</generator>
		<webMaster><?php LayoutHelper::renderField($PAGE, "Email"); ?></webMaster>
		<ttl>5</ttl>
	</channel>
 
<?php LayoutHelper::renderPlaceHolder($PAGE, "RSS"); ?>
	</channel>
</rss>
