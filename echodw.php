<?php

require_once 'vendor/autoload.php';

$ch = new CurlHelper();
$w = new Worker($ch);
$hw = new HtmlWriter();
$lsf = new LinkShortcuttersFarm([
  new TusfilesDownloader($ch),
  //new Rapid8Slave('http://www3.cbox.ws/box/?boxid=3406465&boxtag=rapid8', $ch),
]);

go('La Gazzetta dello Sport', $w, $lsf, $hw);
go('Il Corriere dello sport', $w, $lsf, $hw);
go('Tuttosport', $w, $lsf, $hw);

function go($title, $w, $lsf, $hw)
{
  $todayTopic = $w->getTodayTopic($title);
  $dwLinks = $lsf->processDownloadLinks(
    $todayTopic->downloadLinks()
  );
  
  echo $hw->writeTopic($todayTopic, $dwLinks);
}

