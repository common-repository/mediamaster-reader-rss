<?php
   header('Content-Type: text/xml');
   $url = 'http://www.mediamaster.eu/?feed=rss2';
   print file_get_contents($url);
?>
