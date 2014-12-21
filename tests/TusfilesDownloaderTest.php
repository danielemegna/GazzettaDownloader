<?php

class TusfilesDownloaderTest extends PHPUnit_Framework_TestCase
{

  function testTDCanDownloadFromLink()
  {
    $td = new TusfilesDownloader();
    $downloadLink = "https://www.tusfiles.net/jw1zzzh3eu34";

    $filepath = "/home/daniele/Dropbox/homeip/GazzettaTest.pdf";
    $td->download($downloadLink, $filepath);

    $this->assertFileExists($filepath);
    exec("rm $filepath");
  }

}
