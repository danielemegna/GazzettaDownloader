<?php

interface LinkShortcutter
{
  function isLinkSupported($link);
  function work($link);
}
