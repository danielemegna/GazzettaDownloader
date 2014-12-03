<?php

class WorkerTest extends PHPUnit_Framework_TestCase
{
  function testIsWorking()
  {
    $this->assertTrue(true);
  }

  function testWorkerExists()
  {
    $w = new Worker();
  }

  function testWorkerCanGetTodayTopicLink()
  {
    $d = new DateTime();
    $expected = sprintf(
      'http://vstau.info/%1$s/%2$s/%3$s/la-gazzetta-dello-sport-%3$s-%2$s-%1$s/',
      $d->format("Y"), $d->format("m"), $d->format("d")
    );

    $w = new Worker();
    $todayTopic = $w->getTodayTopicLink();
    $this->assertEquals(
      $expected,
      $todayTopic
    );
  }

  function testWorkerCanGetDownloadLink()
  {
    $w = new Worker();
  }
  
}
