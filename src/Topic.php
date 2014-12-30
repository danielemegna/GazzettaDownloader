<?php

class Topic
{
  public $url;
  public $source;

  function title() {
    $pattern = '!rel="bookmark">([\S\s]+)</a></h1>!';

    preg_match($pattern, $this->source, $matches); 
    if(sizeof($matches) < 2)
      return "";
   
    return $matches[1];
  }

  function downloadLinks()
  {
    $pattern =
      '!<a rel\="nofollow" target\="_blank" href\="(http://[\s\S]+?)">([\s\S]+?)</a>!';
    preg_match_all($pattern, $this->source, $matches); 

    if(sizeof($matches) < 2)
      return [];

    $result = [];
    for($i=0; $i<sizeof($matches[1]); $i++)
    {
      $label = $matches[2][$i];
      $href = $matches[1][$i];
      $result[$label] = $href;
    }

    return $result;
  }

  function downloadLink($provider) {
    $pattern = '$"(https?://'.$provider.'/[\S\s]+?)"$';
    preg_match($pattern, $this->source, $matches); 
    if(sizeof($matches) < 2)
      return "";
   
    return $matches[1];
  }

  function imageurl() {
    $pattern = '!img itemprop\="image" src\="([\S\s]+)" alt\="La Gazzetta dello Sport!i';

    preg_match($pattern, $this->source, $matches); 
    if(sizeof($matches) < 2)
      return "";
   
    return $matches[1];
  }
}

