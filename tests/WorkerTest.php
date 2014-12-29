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

  function testWorkerCanGetCompleteTodayTopic()
  {
    $todayTopic = $this->w->getTodayTopic([
      "www.tusfiles.net"
    ]);

    $urlpattern =
      '!http://vstau.info/[0-9]{2,4}/[0-9]{2}/[0-9]{2}/la-gazzetta-dello-sport-[0-9]{2}-[0-9]{2}-[0-9]{2}/!';

    $this->assertNotNull($todayTopic);
    $this->assertRegExp($urlpattern, $todayTopic->url);
    $this->assertRegExp("!La Gazzetta dello Sport \([0-9]{2}-[0-9]{2}-[0-9]{2}\)!", $todayTopic->title);
    $this->assertRegExp('!https?://www.tusfiles.net/[a-z0-9]{12}!', $todayTopic->downloadLinks["www.tusfiles.net"]);
    $this->assertRegExp("!http://s[0-9]{2}.postimg.org/[a-z0-9]{9}/[a-zA-Z0-9]+.jpg!", $todayTopic->imageurl);
  }

}
