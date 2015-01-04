<?php

class CurlHelper
{
  function getSource($url)
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
  
  function postCall($url, $postData)
  {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);
    $headers = curl_getinfo ($ch);
    curl_close($ch);

    return [$headers, $data];
  }
}
