<?php

class HtmlWriter
{
  function writeTopic($topic, $dwLinks)
  {
    $html = "<center>"; 

    $html .= "<h1>".$topic->title()."</h1>";
    $html .= "<img src='".$topic->imageurl()."' />";
    $html .= "<br><br>";

    $html .= "<a href='$topic->url'>Today topic url</a>";
    $html .= "<br><br>";

    foreach($dwLinks as $dwLink) {
      $html .= "<a href='$dwLink->url'>$dwLink->label</a>";
      if($dwLink->hasShortUrl())
        $html .= " (<a href='$dwLink->shortUrl'>short link</a>)";
      $html .= "<br>";
    }

    $html .= "</center>"; 
    $html .= "<br><br>";

    return $html;
  }
}
