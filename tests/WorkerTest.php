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

    $d = new DateTime();
    $pattern = '$http://vstau.info/[0-9]{2,4}/[0-9]{2}/[0-9]{2}/la-gazzetta-dello-sport-[0-9]{2}-[0-9]{2}-[0-9]{2}/$';

    $this->assertRegExp($pattern, $todayTopic);
  }

  function testWorkerCanGetDownloadLink()
  {
    $w = new Worker();
    $provider = "www.tusfiles.net";
    $downloadLink = $w->getDownloadLink($provider);

    $pattern = '$https?://www.tusfiles.net/[a-z0-9]{12}$';
    $this->assertRegExp($pattern, $downloadLink);
  }

}
