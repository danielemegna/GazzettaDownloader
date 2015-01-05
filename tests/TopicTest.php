<?php

class TopicTest extends PHPUnit_Framework_TestCase
{
  private $t1;
  private $t2;

  function setUp()
  {
    $this->t1 = new Topic();
    $this->t1->source = file_get_contents(__DIR__.'/today-test-topic-1.html');
    $this->t2 = new Topic();
    $this->t2->source = file_get_contents(__DIR__.'/today-test-topic-2.html');
  }

  function testSourceIsNotEmpty()
  {
    $this->assertNotEquals("", $this->t1->source);
    $this->assertNotEquals("", $this->t2->source);
  }

  function testTopicCanExtractTitle()
  {
    $this->assertEquals(
      "La Gazzetta Dello Sport (30.12.2014)",
      $this->t1->title()
    );

    $this->assertEquals(
      "La Gazzetta dello Sport (29-12-14)",
      $this->t2->title()
    );
  }

  function testTopicCanExtractImageurl()
  {
    $this->assertEquals(
      "http://s6.postimg.org/oofarfkhd/screenshot_5.png",
      $this->t1->imageurl()
    );

    $this->assertEquals(
      "http://s18.postimg.org/pf6rmbseh/gazzetta.jpg",
      $this->t2->imageurl()
    );
  }

  function testTopicCanExtractDownloadLinks()
  {
    $dwLinks = $this->t1->downloadLinks();
    $this->assertEquals(3, count($dwLinks));
    $this->assertEquals("easybytez.com", $dwLinks[0]->label);
    $this->assertEquals("rockfile.eu", $dwLinks[1]->label);
    $this->assertEquals("linestorage.com", $dwLinks[2]->label);
    $this->assertEquals("http://www.easybytez.com/pgj84p1h1vmt", $dwLinks[0]->url);
    $this->assertEquals("http://rockfile.eu/3ywg7nl1qlvl.html", $dwLinks[1]->url);
    $this->assertEquals("http://linestorage.com/jiiya2pl0lde", $dwLinks[2]->url);


    $dwLinks = $this->t2->downloadLinks();
    $this->assertEquals(3, count($dwLinks));
    $this->assertEquals("uploaded.net", $dwLinks[0]->label);
    $this->assertEquals("linestorage.com", $dwLinks[1]->label);
    $this->assertEquals("tusfiles.net", $dwLinks[2]->label);

    $this->assertEquals(
      "http://uploaded.net/file/lkyx37d7",
      $dwLinks[0]->url
    );
    $this->assertEquals(
      "http://linestorage.com/29j851prok1x/gazzetta_20141229.pdf.html",
      $dwLinks[1]->url
    );
    $this->assertEquals(
      "http://www.tusfiles.net/ni2x8iqujyod",
      $dwLinks[2]->url
    );
  }

}
