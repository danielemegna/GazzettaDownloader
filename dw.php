<?php

require_once 'vendor/autoload.php';

$provider = "www.tusfiles.net";
$dirpath = "/home/daniele/Dropbox/homeip/gazzette/";

$ch = new CurlHelper();
$w = new Worker($ch);
$td = new TusfilesDownloader($ch);
$today = new DateTime();

$downloadLink = $w->getDownloadLink($provider);
$directLink = $td->getFileDirectLink($downloadLink);
echo $directLink;
die();

$filename = "GDS_".$today->format("Ymd").".pdf";
file_put_contents(
  $dirpath.$filename,
  file_get_contents($directLink)
);

$oldDate = $today->sub(new DateInterval("P4D"));
$filename = "GDS_".$oldDate->format("Ymd").".pdf";

exec('rm '.$dirpath.$filename);
