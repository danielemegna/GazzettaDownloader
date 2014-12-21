<?php

class TusfilesDownloaderTest extends PHPUnit_Framework_TestCase
{
  private $td;

  function setUp()
  {
    $this->td = new TusfilesDownloader(
      new CurlHelper()
    );
  }

  function testTDCanDownloadFromLink()
  {
    $downloadLink = "https://www.tusfiles.net/jw1zzzh3eu34";

    $filepath = "/home/daniele/Dropbox/homeip/GazzettaTest.pdf";
    $this->td->download($downloadLink, $filepath);

    $this->assertFileExists($filepath);
    exec("rm $filepath");

    // http://p.tusfiles.net/d/a4k3rch5tz2fvxijr7zzjfqgcb3zsdsih6dataipb62qpuumpmp7kgjd/GDS(2014_12_03).pdf
  }

}
