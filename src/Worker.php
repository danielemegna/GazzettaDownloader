<?php

class Topic
{
  public $url;
  public $htmlSource;
  public $title;
  public $downloadLinks;
  public $imageurl;
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
    
    $topic->url = $this->getTodayTopicLink();
    $topic->htmlSource = $this->curlHelper->getSource($topic->url);
    $topic->title = $this->getTitleFromTopicSource($topic->htmlSource);
    $topic->imageurl = $this->getImageurlFromTopicSource($topic->htmlSource);

    foreach($providers as $provider)
      $topic->downloadLinks[$provider] = $this->getDownloadLinkFromTopicSource($topic->htmlSource, $provider);

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

  private function getTitleFromTopicSource($source)
  {
    $pattern = '!rel="bookmark">([\S\s]+)</a></h1>!';

    preg_match($pattern, $source, $matches); 
    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today topic title!");
   
    return $matches[1];
  }

  private function getImageurlFromTopicSource($source)
  {
    $pattern = '!img itemprop\="image" src\="([\S\s]+)" alt\="La Gazzetta dello Sport!';

    preg_match($pattern, $source, $matches); 
    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today image link!");
   
    return $matches[1];
  }

  private function getDownloadLinkFromTopicSource($source, $provider)
  {
    $pattern = '$"(https?://'.$provider.'/[\S\s]+?)"$';
    preg_match($pattern, $source, $matches); 
    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today download link!");
   
    return $matches[1];
  }
}
