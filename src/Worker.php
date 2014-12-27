<?php

class Topic
{
  public $title;
  public $links;
}

class Worker
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function getTodayTopic($providers)
  {
    $topic = new Topic();
    
    $todayTopicLink = $this->getTodayTopicLink();
    $todayTopicSource = $this->curlHelper->getSource($todayTopicLink);

    $topic->title = $this->getTitleFromTopicSource($todayTopicSource);

    foreach($providers as $provider)
      $topic->links[$provider] = $this->getDownloadLinkFromTopicSource($todayTopicSource, $provider);

    return $topic;
  }

  function getTodayTopicLink()
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

  function getDownloadLink($provider)
  {
    $todayTopicLink = $this->getTodayTopicLink();
    $source = $this->curlHelper->getSource($todayTopicLink);
    return $this->getDownloadLinkFromTopicSource($source, $provider);
  }

  function getDownloadLinkFromTopicSource($source, $provider)
  {
    $pattern = '$"(https?://'.$provider.'/[\S\s]+?)"$';
    preg_match($pattern, $source, $matches); 
    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today download link!");
   
    return $matches[1];
  }

  function getTitleFromTopicSource($source)
  {
    $pattern = '!rel="bookmark">([\S\s]+)</a></h1>!';

    preg_match($pattern, $source, $matches); 
    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today topic title!");
   
    return $matches[1];
  }

}
