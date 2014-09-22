<?php
	header("Content-Type: application/rss+xml; charset=UTF-8");
	
	$rss = '<?xml version="1.0" encoding="utf-8"?>';
	$rss .= '<rss xmlns:a10="http://www.w3.org/2005/Atom" version="2.0"';

	$rss .= '>';
	
	$rss .= '<channel>';
	$rss .= '<title>NNT NEWS</title>';
	$rss .= '<link>ทดสอบ</link>';
	$rss .= '<description">NNT News Feed</description>';
	$rss .= '<a10:id>NNT News Feed</a10:id>';

	$rss .= '<item>';
	$rss .= '<guid isPermaLink="false">ทดสอบ';
	$rss .= '</guid>';
	$rss .= '<link>ทดสอบ';
	$rss .= '</link>';
	$rss .= '<title>ทดสอบ';
	$rss .= '</title>';


	$rss .= '<description>';
	$rss .= '<![CDATA[
			ทดสอบ
	]]>';
	$rss .= '</description>';

	$rss .= '<a10:updated>'.date('c');
	$rss .= '</a10:updated>';

	$rss .= '<pubDate>'.date('c');
	$rss .= '</pubDate>';
	$rss .= '<updated>'.date('c');
	$rss .= '</updated>';
	$rss .= '</item>';

	$rss .= '</channel>';
	$rss .= '</rss>';
	echo $rss;
?>
	