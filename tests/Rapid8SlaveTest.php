<?php

class Rapid8SlaveTest extends PHPUnit_Framework_TestCase
{
  private $r8s;

  function setUp()
  {
    $this->r8s = new Rapid8Slave(
      'http://www3.cbox.ws/box/?boxid=3406465&boxtag=rapid8',
      new CurlHelper()
    );
  }

  function testRapid8SlaveRecognizesProviders()
  {
    $link = 'http://uploaded.net/file/wmrhn8gt/sole24ore20150104.pdf';
    $this->assertTrue($this->r8s->isLinkSupported($link));

    $link = 'http://rapidgator.net/file/1380cb57ed533790984e3ba07f9ad669/test.html';
    $this->assertTrue($this->r8s->isLinkSupported($link));
  }
}