<?php

class Worker
{
  function getTodayTopicLink()
  {
    $source = $this->getSourceWithCurl("http://vstau.info/category/giornali/");
    $pattern = '$Download La Gazzetta dello Sport[\S\s]+'
      .'(http://vstau.info/[\S\s]+la-gazzetta-dello-sport-[0-9]{2}-[0-9]{2}-[0-9]{4}/)$';

    preg_match($pattern, $source, $matches); 
    if(sizeof($matches) < 2)
      throw new Exception("Cannot find today topic link!");
   
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
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
}
