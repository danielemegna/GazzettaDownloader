<?php

class TusfilesDownloader
{
  private $curlHelper;

  function __construct($curlHelper)
  {
    $this->curlHelper = $curlHelper;
  }

  function getFileDirectLink($link)
  {
    if($link == null || $link == '')
      return '';

    $rand = $this->getRandValueFromTusfilePageLink($link);
    $id = $this->getIdValueFromTusfilePageLink($link);

    $ch = curl_init($link);
    $params = array(
      'op' => 'download2',
      'id' => $id,
      'rand' => $rand,
      'referer' => '',
      'method_free' => '',
      'method_premium' => '',
      'down_script' => '1',
    );

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);
    $header = curl_getinfo ($ch);
    curl_close($ch);

    return $header['redirect_url'];
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
