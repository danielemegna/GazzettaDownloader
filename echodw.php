<?php

require_once 'vendor/autoload.php';

$ch = new CurlHelper();
$w = new Worker($ch);

$todayTopic = $w->getTodayTopic();
$dwLinks = $todayTopic->downloadLinks();

/*if(isset($dwLinks["tusfiles.net"])) {
  $td = new TusfilesDownloader($ch);
  $tusfilesDirectLink = $td->getFileDirectLink($tusfilesDownloadLink);
}*/

?>
<center>

  <h1><?php echo $todayTopic->title(); ?></h1>
  <img src='<?php echo $todayTopic->imageurl(); ?>'/>
  <br><br>

  <a href='<?php echo $todayTopic->url; ?>'>Today topic url</a>
  <br/>
  <?php foreach($dwLinks as $label => $href) { ?>
    <a href='<?php echo $href; ?>'><?php echo $label; ?></a>
    <br/>
  <?php } ?>

</center>
