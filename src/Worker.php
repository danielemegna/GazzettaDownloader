<?php

class Worker
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function getTodayTopic($titlePrefix)
  {
    $topic = new Topic();
    
    $topic->url = $this->getTodayTopicLink($titlePrefix);
    $topic->source = $this->curlHelper->getSource($topic->url);

    return $topic;
  }

  private function getTodayTopicLink($titlePrefix)
  {
    $source = $this->curlHelper->getSource("http://vstau.info/category/giornali/");
    $pattern = '!<a itemprop\="url" href\="(http://vstau.info/[\S]+?)" title\="'.$titlePrefix.
      '[\s\S]+?" rel\="bookmark">'.$titlePrefix.'[\s\S]+?</a>!i';

    preg_match($pattern, $source, $matches); 

    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today topic link for titleprefix [$titleprefix]!");
   
    return $matches[1];
  }
}
