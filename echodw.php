<?php

require_once 'vendor/autoload.php';

$w = new Worker();
$provider = "www.tusfiles.net";
$downloadLink = $w->getDownloadLink($provider);

echo $downloadLink;
