<?php

class LinkShortcuttersFarm
{
  private $linkShortcutters;

  function __construct($linkShortcutters)
  {
    $this->linkShortcutters = $linkShortcutters;
  }

  function processDownloadLinks($links)
  {
    foreach($links as $link) {
      foreach($this->linkShortcutters as $ls) {
        if($ls->isLinkSupported($link->url))
          $link->shortUrl = $ls->work($link->url);
      }
    }

    return $links;
  }
}
