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
    $rand = $this->getRandValueFromTusfilePageLink($link);

    $ch = curl_init($link);
    $params = array(
      'op' => 'download2',
      'id' => 'jw1zzzh3eu34',
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

  private function getRandValueFromTusfilePageLink($link)
  {
    $source = $this->curlHelper->getSource($link);
    $pattern = '!<input type\="hidden" name\="rand" value\="([a-z0-9]{39})">!';
    preg_match($pattern, $source, $matches); 
    return $matches[1];
  }
}
