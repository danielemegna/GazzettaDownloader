<?php

class DownloadLink
{
  public $label;
  public $url;
  public $shortUrl;

  function __construct($label, $url, $shortUrl = null)
  {
    $this->label = $label;
    $this->url = $url;
    $this->shortUrl = $shortUrl;
  }

  function hasShortUrl()
  {
    return ($this->shortUrl != null && $this->shortUrl != '');
  }
}
