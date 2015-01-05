<?php

class Rapid8Slave implements LinkShortcutter
{
  const SECOND_TO_WAIT_FOR_RESPONSE = 5; 

  private $cboxUrl;
  private $curlHelper;
  private $supportedProviders; 

  function __construct($cboxUrl, $curlHelper)
  {
    $this->cboxUrl = $cboxUrl;
    $this->curlHelper = $curlHelper;

    $this->supportedProviders = ["1Fichier", "2Shared", "Dailymotion", "Depfile", "Filefactory", "Filepost", "FileRio", "Filesflash", "Hugefiles.net", "Kingfiles.net", "Mixturecloud", "Nowdownload.ch", "Rapidgator.net", "Sendspace", "Share-Online.biz", "Speedyshare", "Uploadable", "Uploaded.net", "Uploading", "Uploadto.us", "Uptobox", "YouTube", "Zippyshare", "Asfile", "Clicknupload", "Extmatrix", "Fboom.me", "Filetut", "Lafiles", "Megairon.net", "vimeo.com"];
  }
  
  function isLinkSupported($link)
  {
    $link = strtolower($link);
    foreach($this->supportedProviders as $provider) {
      if(strpos($link,strtolower($provider)) !== false)
        return true;
    }

    return false; 
  }

  function work($linkToDownload)
  {
    $this->sendMessageToBox($linkToDownload);

    sleep(self::SECOND_TO_WAIT_FOR_RESPONSE);

    return $this->getReplyFromBox(
      '!<b>@shady90</b></span>[\s]+<div align\="center"><b><a href\="([\S\s]+?)" target\="_blank">!'
    );
  }

  private function getReplyFromBox($responsePattern)
  {
    $source = $this->curlHelper->getSource($this->cboxUrl.'&sec=main');
    preg_match($responsePattern, $source, $matches);

    if(sizeof($matches) < 2)
      return "";

    return $matches[1];
  }

  private function sendMessageToBox($message)
  {
    $this->curlHelper->postCall($this->cboxUrl.'&sec=submit', [
      'nme' => 'shady90',
      'eml' => '',
      'key' => 'd37adf94349c8daa2cfcdf54e523cf2003007122',
      'fkey' => '',
      'pic' => '',
      'auth' => '',
      'pst' => $message,
      'captme' => '',
      'capword' => '',
      'caphash' => '',
      'aj' => 'x',
      'lp' => '81386',
    ]);
  }

}
