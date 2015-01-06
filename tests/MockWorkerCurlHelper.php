<?php

class MockWorkerCurlHelper
{
  function getSource($url)
  {
    if($url == 'http://vstau.info/category/giornali/')
      return file_get_contents(__DIR__.'/giornali-homepage-test.html');
    
    if($url == 'http://vstau.info/2015/01/06/la-gazzetta-dello-sport-06-01-15/')
      return 'this is the source of gazzetta today topic';

    if($url == 'http://vstau.info/2015/01/06/il-corriere-dello-sport-ed-nazionale-06-01-2015-2/')
      return 'this is the source of corriere dello sport today topic';

    if($url == 'http://vstau.info/2015/01/06/tuttosport-ed-nazionale-06-01-2014/')
      return 'this is the source of tuttosport today topic';

    return '';
  }
}
