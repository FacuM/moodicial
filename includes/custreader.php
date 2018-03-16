<?php
$dir = 'custom';
if (is_dir($dir))
{
  foreach(scandir($dir) as $html)
  {
    if ($html[0] != '.')
    {
      echo file_get_contents($dir . '/' . $html);
    }
  }
}
?>
