<?php

class TusfilesDownloaderTest extends PHPUnit_Framework_TestCase
{
  private $td;

  function setUp()
  {
    $this->td = new TusfilesDownloader(
      new CurlHelper()
    );
  }

  function testTDCanRecognizeProvider()
  {
    $pageLink = "https://www.tusfiles.net/tpco7e9hn3oz";
    $this->assertTrue($this->td->isLinkSupported($pageLink));
  }

  // This is the only test that uses network and do real post calls
  /*function testTDCanDownloadFromLink()
  {
    //$this->markTestSkipped();

    $pageLink = "https://www.tusfiles.net/jw1zzzh3eu34";
    $directLink = $this->td->work($pageLink);
    
    $pattern = "!http://p\.tusfiles\.net/d/[a-z0-9]{56}/GDS\([0-9]{4}_[0-9]{2}_[0-9]{2}\)\.pdf!";
    $this->assertRegExp($pattern, $directLink);
  }*/
}
