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

  function downloadLink($provider) {
    $pattern = '$"(https?://'.$provider.'/[\S\s]+?)"$';
    preg_match($pattern, $this->source, $matches); 
    if(sizeof($matches) < 2)
      return "";
   
    return $matches[1];
  }

  function imageurl() {
    $pattern = '!img itemprop\="image" src\="([\S\s]+)" alt\="La Gazzetta dello Sport!';

    preg_match($pattern, $this->source, $matches); 
    if(sizeof($matches) < 2)
      return "";
   
    return $matches[1];
  }
}

