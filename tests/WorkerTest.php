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
    $w = new Worker();
    $todayTopic = $w->getTodayTopicLink();
    $this->assertEquals(
      "http://vstau.info/2014/12/03/la-gazzetta-dello-sport-03-12-2014/",
      $todayTopic
    );
  }
}
