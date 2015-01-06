<?php

class TusfilesDownloader implements LinkShortcutter
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function isLinkSupported($link)
  {
    $link = strtolower($link);
    return (strpos($link,"tusfiles.net") !== false);
  }

  function work($link)
  {
    try {
      if($link == null || $link == '')
        return '';

      $id = $this->getIdValueFromTusfilePageLink($link);
      $rand = $this->getRandValueFromTusfilePageLink($link);
      $response = $this->postDownloadRequestToDownloadPage($link, $id, $rand);

      $headers = $response[0];
      
      if(!isset($headers['redirect_url']))
        return "";

      return $headers['redirect_url'];
    } catch(Exception $ex) {
      return '';
    }
  }

  private function postDownloadRequestToDownloadPage($link, $id, $rand)
  {
    return $this->curlHelper->postCall($link, [
      'op' => 'download2',
      'id' => $id,
      'rand' => $rand,
      'referer' => '',
      'method_free' => '',
      'method_premium' => '',
      'down_script' => '1',
    ]);
  }

  private function getIdValueFromTusfilePageLink($link)
  {
    $pattern = '!www.tusfiles.net/([a-z0-9]{12})!';
    preg_match($pattern, $link, $matches);
    return $matches[1];
  }

  private function getRandValueFromTusfilePageLink($link)
  {
    $source = $this->curlHelper->getSource($link);
    $pattern = '!<input type\="hidden" name\="rand" value\="([a-z0-9]{39})">!';
    preg_match($pattern, $source, $matches); 
    return $matches[1];
  }
}
