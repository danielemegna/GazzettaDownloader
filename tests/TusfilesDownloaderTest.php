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

  function testTDCanDownloadFromLink()
  {
    $pageLink = "https://www.tusfiles.net/jw1zzzh3eu34";
    $directLink = $this->td->getFileDirectLink($pageLink);
    
    $pattern = "!http://p\.tusfiles\.net/d/[a-z0-9]{56}/GDS\([0-9]{4}_[0-9]{2}_[0-9]{2}\)\.pdf!";
    $this->assertRegExp($pattern, $directLink);
  }
}
