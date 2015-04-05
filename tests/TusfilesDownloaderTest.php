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

  function testExtendingDownloaderWithUserscloudLinks()
  {
    $pageLink = "https://userscloud.com/p0lacsyib6bd";
    $this->assertTrue($this->td->isLinkSupported($pageLink));
  }

  // This test uses network and do real post calls
  function testTDCanDownloadFromTusfilesLink()
  {
    $this->markTestSkipped();

    $pageLink = "https://www.tusfiles.net/jw1zzzh3eu34";
    $directLink = $this->td->work($pageLink);

    $pattern = "!http://p\.tusfiles\.net/d/[a-z0-9]{56}/GDS\([0-9]{4}_[0-9]{2}_[0-9]{2}\)\.pdf!";
    $this->assertRegExp($pattern, $directLink);
  }

  // This test uses network and do real post calls
  function testTDCanDownloadFromUserscloudLink()
  {
    $this->markTestSkipped();

    $pageLink = "https://userscloud.com/p0lacsyib6bd";
    $directLink = $this->td->work($pageLink);
    
    $pattern = "!http://download[0-9]{1}.userscloud.com/d/[a-z0-9]{56}/.+.pdf!";;
    $this->assertRegExp($pattern, $directLink);
  }
}
