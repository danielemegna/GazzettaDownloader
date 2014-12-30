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

  function testWorkerCanGetTodayTopic()
  {
    $todayTopic = $this->w->getTodayTopic();

    $urlpattern =
      '!http://vstau.info/[0-9]{2,4}/[0-9]{2}/[0-9]{2}/la-gazzetta-dello-sport-[0-9]{2}-[0-9]{2}-[0-9]{2,4}/!';

    $this->assertNotNull($todayTopic);
    $this->assertRegExp($urlpattern, $todayTopic->url);
    //$this->assertRegExp("!La Gazzetta dello Sport \([0-9-.]+\)!i", $todayTopic->title());
    //$this->assertRegExp("!http://s[0-9]{1,2}.postimg.org/[a-z0-9]{9}/[\S]+.(jpg|png)!", $todayTopic->imageurl());
  }

}
