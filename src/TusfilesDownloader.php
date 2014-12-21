<?php

class TusfilesDownloader
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function download($link, $filepath)
  {
    $this->curlHelper->getSource($link);
    exec("touch $filepath"); 
  }
}
