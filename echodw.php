<?php

require_once 'vendor/autoload.php';

$ch = new CurlHelper();
$w = new Worker($ch);

$linkShortcutters = [
  new TusfilesDownloader($ch),
  //new Rapid8Slave('http://www3.cbox.ws/box/?boxid=3406465&boxtag=rapid8', $ch),
];

$todayTopic = $w->getTodayTopic();
$dwLinks = $todayTopic->downloadLinks();

foreach($dwLinks as $dwLink) {
  foreach($linkShortcutters as $ls) {
    if($ls->isLinkSupported($dwLink->url))
      $dwLink->shortUrl = $ls->work($dwLink->url);
  }
}

?>
<center>

  <h1><?php echo $todayTopic->title(); ?></h1>
  <img src='<?php echo $todayTopic->imageurl(); ?>'/>
  <br><br>

  <a href='<?php echo $todayTopic->url; ?>'>Today topic url</a>
  <br><br>

  <?php foreach($dwLinks as $dwLink) { ?>
    <a href='<?php echo $dwLink->url; ?>'><?php echo $dwLink->label; ?></a>
    <?php if($dwLink->hasShortUrl()) {
      echo "(<a href='".$dwLink->shortUrl."'>short link</a>)";
    }?>
    <br/>
  <?php } ?>

</center>
