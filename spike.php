<?php

require_once 'vendor/autoload.php';

$r = new Rapid8Slave(
  'http://www3.cbox.ws/box/?boxid=3406465&boxtag=rapid8',
  new CurlHelper()
);

echo $r->work('http://uploaded.net/file/wmrhn8gt/sole24ore20150104.pdf');
echo PHP_EOL;
