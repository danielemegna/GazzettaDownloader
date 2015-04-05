<?php

class UserscloudDownloader implements LinkShortcutter
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function isLinkSupported($link)
  {
    $link = strtolower($link);
    return (strpos($link,"userscloud.com") !== false);
  }

  function work($link)
  {
    throw new Exception("Not implemented yet");
  }
}
