<?php

class Worker
{
  const VSTAU_INFO_URL = "http://vstau.info/category/giornali/";
  const PAGE_CHANGE_PREFIX = "page/";
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
    $pattern = '!<a itemprop\="url" href\="(http://vstau.info/[\S]+?)" title\="'.$titlePrefix.
      '[\s\S]+?" rel\="bookmark">'.$titlePrefix.'[\s\S]+?</a>!i';

    $urlSuffix = ""; $nextPage = 2;
    do {
      if($nextPage == 5) { throw new Exception("Cannot find today topic link for titleprefix [$titlePrefix]!"); }

      $source = $this->curlHelper->getSource(self::VSTAU_INFO_URL.$urlSuffix);
      $urlSuffix = self::PAGE_CHANGE_PREFIX.$nextPage++.'/';
      preg_match($pattern, $source, $matches); 
    } while(sizeof($matches) < 2);
   
    return $matches[1];
  }
}
