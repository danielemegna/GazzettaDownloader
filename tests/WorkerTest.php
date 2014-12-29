<?php

class WorkerTest extends PHPUnit_Framework_TestCase
{
  private $w;

  function setUp()
  {
    $this->w = new Worker(
      new CurlHelper()
    );
  }
  
  function testIsWorking()
  {
    $this->assertTrue(true);
  }

  function testWorkerExists()
  {
    $this->assertNotNull($this->w);
  }

  function testWorkerCanGetTodayTopicLink()
  {
    $todayTopic = $this->w->getTodayTopicLink();
    $pattern = '$http://vstau.info/[0-9]{2,4}/[0-9]{2}/[0-9]{2}/la-gazzetta-dello-sport-[0-9]{2}-[0-9]{2}-[0-9]{2}/$';

    $this->assertRegExp($pattern, $todayTopic);
  }

  function testWorkerCanGetDownloadLink()
  {
    $provider = "www.tusfiles.net";
    $downloadLink = $this->w->getDownloadLink($provider);

    $pattern = '$https?://www.tusfiles.net/[a-z0-9]{12}$';
    $this->assertRegExp($pattern, $downloadLink);
  }

  function testWorkerCanGetTodayTopicWithTusfilesLink()
  {
    $todayTopic = $this->w->getTodayTopic([
      "www.tusfiles.net"
    ]);

    $this->assertNotNull($todayTopic);
    $this->assertRegExp("!La Gazzetta dello Sport \([0-9]{2}-[0-9]{2}-[0-9]{2}\)!", $todayTopic->title);
    $this->assertRegExp('$https?://www.tusfiles.net/[a-z0-9]{12}$', $todayTopic->links["www.tusfiles.net"]);
  }
}
