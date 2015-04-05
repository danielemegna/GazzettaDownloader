<?php

class UserscloudDownloaderTest extends PHPUnit_Framework_TestCase
{
  private $ud;

  function setUp()
  {
    $this->ud = new UserscloudDownloader(
      new CurlHelper()
    );
  }

  function testUDCanRecognizeProvider()
  {
    $pageLink = "https://userscloud.com/p0lacsyib6bd";
    $this->assertTrue($this->ud->isLinkSupported($pageLink));

    $pageLink = "https://www.tusfiles.net/tpco7e9hn3oz";
    $this->assertFalse($this->ud->isLinkSupported($pageLink));
  }
  
}
