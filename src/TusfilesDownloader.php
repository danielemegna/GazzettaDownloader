<?php

class TusfilesDownloader
{
  function download($link, $filepath)
  {
    
    exec("touch $filepath"); 
  }
}
