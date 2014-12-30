<?php

require_once 'vendor/autoload.php';

$ch = new CurlHelper();
$w = new Worker($ch);

$todayTopic = $w->getTodayTopic();
$tusfilesDownloadLink = $todayTopic->downloadLink("www.tusfiles.net");

$td = new TusfilesDownloader($ch);
$tusfilesDirectLink = $td->getFileDirectLink($tusfilesDownloadLink);

?>
<center>

  <h1><?php echo $todayTopic->title(); ?></h1>
  <img src='<?php echo $todayTopic->imageurl(); ?>'/>
  <br><br>

  <a href='<?php echo $todayTopic->url; ?>'>Today topic url</a>
  <br/>
  <a href='<?php echo $tusfilesDownloadLink; ?>'>Tusfiles Link</a>
  <br/>
  <a href='<?php echo $tusfilesDirectLink; ?>'>Tusfiles Direct Link</a>

</center>
