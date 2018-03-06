<?php
require_once("config.php");
if ($reports == false)
{
  header('location: ' . $root . '?reporterr=true');
}
elseif (!isset($_POST['report']))
{
  header('location: ' . $root);
}
else
{
  foreach($server->query("SELECT * FROM `" . $credentials['ptable'] . "` WHERE `pid` = " . $server->quote($_POST['report'])) as $rows)
  {
    echo $rows['rep'];
    if ($rows['rep'] >= $maxrep)
    {
      $server->query("DELETE FROM `" . $credentials['ptable'] . "` WHERE `pid` = " . $server->quote($_POST['report']));
    }
    else
    {
      $server->query("UPDATE `" . $credentials['ptable'] . "` SET `rep`=rep+1 WHERE `pid` = " . $server->quote($_POST['report']));
    }
  }
}
?>
