<?php

require_once __DIR__.'/MockWorkerCurlHelper.php';

class WorkerTest extends PHPUnit_Framework_TestCase
{
  private $w;

  function setUp()
  {
    $this->w = new Worker(
      new MockWorkerCurlHelper()
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

  function testWorkerCanGetVariousTodayTopics()
  {
    $expectedUrl = 'http://vstau.info/2015/01/06/la-gazzetta-dello-sport-06-01-15/';
    $expectedSource = 'this is the source of gazzetta today topic';
    $todayTopic = $this->w->getTodayTopic('La Gazzetta dello Sport');

    $this->assertNotNull($todayTopic);
    $this->assertEquals($expectedUrl, $todayTopic->url);
    $this->assertEquals($expectedSource, $todayTopic->source);

    $expectedUrl = 'http://vstau.info/2015/01/06/il-corriere-dello-sport-ed-nazionale-06-01-2015-2/';
    $expectedSource = 'this is the source of corriere dello sport today topic';
    $todayTopic = $this->w->getTodayTopic('Il corriere dello sport');

    $this->assertNotNull($todayTopic);
    $this->assertEquals($expectedUrl, $todayTopic->url);
    $this->assertEquals($expectedSource, $todayTopic->source);

    $expectedUrl = 'http://vstau.info/2015/01/06/tuttosport-ed-nazionale-06-01-2014/';
    $expectedSource = 'this is the source of tuttosport today topic';
    $todayTopic = $this->w->getTodayTopic('Tuttosport');

    $this->assertNotNull($todayTopic);
    $this->assertEquals($expectedUrl, $todayTopic->url);
    $this->assertEquals($expectedSource, $todayTopic->source);
  }

}
