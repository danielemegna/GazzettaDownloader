<?php

class Worker
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function getTodayTopic()
  {
    $topic = new Topic();
    
    $topic->url = $this->getTodayTopicLink();
    $topic->source = $this->curlHelper->getSource($topic->url);

    return $topic;
  }

  private function getTodayTopicLink()
  {
    $source = $this->curlHelper->getSource("http://vstau.info/category/giornali/");
    $pattern = '$(http://vstau.info/[\S\s]{10}/la-gazzetta-dello-sport-[0-9]{2}-[0-9]{2}-[0-9]{2,4}/)$';

    preg_match($pattern, $source, $matches); 

    if(sizeof($matches) < 2) {
      $source = $this->curlHelper->getSource("http://vstau.info/category/giornali/page/2");
      preg_match($pattern, $source, $matches); 

      if(sizeof($matches) < 3)
        throw new Exception("Cannot find today topic link!");
   }
   
    return $matches[1];
  }
}
