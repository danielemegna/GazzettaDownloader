<?php

class Worker
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function getTodayTopicLink()
  {
    $source = $this->getSourceWithCurl("http://vstau.info/category/giornali/");
    $pattern = '$(http://vstau.info/[\S\s]{10}/la-gazzetta-dello-sport-[0-9]{2}-[0-9]{2}-[0-9]{2,4}/)$';

    preg_match($pattern, $source, $matches); 

    if(sizeof($matches) < 2) {
      $source = $this->getSourceWithCurl("http://vstau.info/category/giornali/page/2");
      preg_match($pattern, $source, $matches); 

      if(sizeof($matches) < 3)
        throw new Exception("Cannot find today topic link!");
   }
   
    return $matches[1];
  }

  function getDownloadLink($provider)
  {
    $source = $this->getSourceWithCurl(
      $this->getTodayTopicLink()
    );

    $pattern = '$"(https?://'.$provider.'/[\S\s]+?)"$';
    preg_match($pattern, $source, $matches); 
    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today download link!");
   
    return $matches[1];
  }

  private function getSourceWithCurl($url)
  {
    return $this->curlHelper->getSource($url);
  }
}
