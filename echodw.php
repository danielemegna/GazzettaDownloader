<?php

require_once 'vendor/autoload.php';

$ch = new CurlHelper();
$w = new Worker($ch);
$td = new TusfilesDownloader($ch);

$provider = "www.tusfiles.net";
$downloadLink = $w->getDownloadLink($provider);
$directLink = $td->getFileDirectLink($downloadLink);

echo "<a href='$downloadLink'>$downloadLink</a>";
echo "<br/>";
echo "<a href='$directLink'>$directLink</a>";
