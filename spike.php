<?php

require_once 'vendor/autoload.php';

echo 'Posting request..'.PHP_EOL;

$url = 'http://www3.cbox.ws/box/index.php?boxid=3406465&boxtag=rapid8&sec=submit';
$ch = curl_init($url);
$params = array(
  'nme' => 'shady90',
  'eml' => '',
  'key' => 'd37adf94349c8daa2cfcdf54e523cf2003007122',
  'fkey' => '',
  'pic' => '',
  'auth' => '',
  'pst' => 'http://uploaded.net/file/l9x5h5rj/repubblica20150102.pdf',
  'captme' => '',
  'capword' => '',
  'caphash' => '',
  'aj' => 'x',
  'lp' => '81386',
);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($ch);
$header = curl_getinfo ($ch);
curl_close($ch);

echo 'Wait 5 seconds...'.PHP_EOL;
sleep(5);

echo 'Getting response..'.PHP_EOL;
$ch = new CurlHelper();
$source = $ch->getSource("http://www3.cbox.ws/box/?boxid=3406465&boxtag=rapid8&sec=main");

$pattern = '!<b>@shady90</b></span>[\s]+<div align\="center"><b><a href\="([\S\s]+?)" target\="_blank">!';
preg_match($pattern, $source, $matches);
echo $source;
var_dump($matches);
die();
