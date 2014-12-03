<?php

class Worker
{
  function getTodayTopicLink()
  {
    $source = $this->getSourceWithCurl("http://vstau.info/category/giornali/");

    return "http://vstau.info/2014/12/03/la-gazzetta-dello-sport-03-12-2014/";
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
