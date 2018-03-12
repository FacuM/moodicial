<?php
require_once("../config.php");
session_start();
if (!empty($_GET))
{
$content = array ('posts', 'comments');
if (!isset($_GET['key_private']))
{
  if (isset($_GET['request']) && $_GET['request'] == 'global')
  {
    if (isset($_SESSION['global_public_last']))
    {
      $time = microtime(true) -  $_SESSION['global_public_last'];
    }
    if (isset($_SESSION['global_public_last']) && $time < $api['global_public'] / 1000)
    {
      die('Rate limit excedded.');
    }
    else
    {
      printf(json_encode($content[0]));
      $_SESSION['global_public_last'] = microtime(true);
      foreach ($server->query('SELECT * FROM ' . $credentials['ptable'] . ' ORDER BY date DESC') as $rows)
      {
        printf(json_encode($rows));
      }
      printf(json_encode($content[1]));
      foreach ($server->query('SELECT * FROM ' . $credentials['ctable']) as $rows)
      {
        printf(json_encode($rows));
      }
    }
  } elseif (isset($_GET['request']) && $_GET['request'] == 'single' && isset($_GET['pid']))
  {
    if (isset($_SESSION['single_public_last']))
    {
      $time = microtime(true) -  $_SESSION['single_public_last'];
    }
    if (isset($_SESSION['single_public_last']) && $time < $api['single_public'] / 1000)
    {
      die('Rate limit excedded.');
    }
    else
    {
      printf(json_encode($content[0]));
      $_SESSION['single_public_last'] = microtime(true);
      foreach ($server->query('SELECT * FROM ' . $credentials['ptable'] . ' WHERE pid = ' . $server->quote($_GET['pid'])) as $rows)
      {
        printf(json_encode($rows));
      }
      printf(json_encode($content[1]));
      foreach ($server->query('SELECT * FROM ' . $credentials['ctable'] . ' WHERE pid = ' . $server->quote($_GET['pid'])) as $rows)
      {
        printf(json_encode($rows));
      }
    }
  }
}
else
{
  if (isset($_GET['key_private']) && $_GET['key_private'] == $api['key_private'])
  {
    if (isset($_GET['request']) && $_GET['request'] == 'global')
    {
      if (isset($_SESSION['global_private_last']))
      {
        $time = microtime(true) -  $_SESSION['global_private_last'];
      }
      if (isset($_SESSION['global_private_last']) && $time < $api['global_private'] / 1000)
      {
        die('Rate limit excedded.');
      }
      else
      {
        printf(json_encode($content[0]));
        $_SESSION['global_private_last'] = microtime(true);
        foreach ($server->query('SELECT * FROM ' . $credentials['ptable'] . ' ORDER BY date DESC') as $rows)
        {
          printf(json_encode($rows));
        }
        printf(json_encode($content[1]));
        foreach ($server->query('SELECT * FROM ' . $credentials['ctable']) as $rows)
        {
          printf(json_encode($rows));
        }
      }
    } elseif (isset($_GET['request']) && $_GET['request'] == 'single' && isset($_GET['pid']))
    {
      if (isset($_SESSION['single_private_last']))
      {
        $time = microtime(true) -  $_SESSION['single_private_last'];
      }
      if (isset($_SESSION['single_private_last']) && $time < $api['single_private'] / 1000)
      {
        die('Rate limit excedded.');
      }
      else
      {
        printf(json_encode($content[0]));
        $_SESSION['single_private_last'] = microtime(true);
        foreach ($server->query('SELECT * FROM ' . $credentials['ptable'] . ' WHERE pid = ' . $server->quote($_GET['pid'])) as $rows)
        {
          printf(json_encode($rows));
        }
        printf(json_encode($content[1]));
        foreach ($server->query('SELECT * FROM ' . $credentials['ctable'] . ' WHERE pid = ' . $server->quote($_GET['pid'])) as $rows)
        {
          printf(json_encode($rows));
        }
      }
    }
  }
  else
  {
    if (isset($_GET['key_private']) && $_GET['key_private'] != $api['key_private'])
    {
      echo 'Wrong API key, please try again. If the problem persists, contact the system administrator.';
    }
  }
}
}
 else
 {
   echo '

   Welcome to the Moodicial API!<br><br>

   This service will let you grab data from the server\'s database formatted as JSON.<br><br><br>

   These are the possible values: <br>

   Format: ("variable" = [option1|option2|...])<br><br>

   <table>
    <tr>
     <td>pid = </td><td>[post id]</td>
    </tr>
    <tr>
     <td>request =</td><td>[global|single<font color=red>*</font>]</td>
    <tr>
     <td>key_private = </td><td>[private key]</td>
    </td>
   </table>
   <br>
   &nbsp;&nbsp;= Global: get the whole database.<br>
   <font color=red>*</font>= Single: get a single post. (requires "pid")<br><br>

   ====== API Configuration ======<br><br>

   Enabled: ' . ($api['enable'] ? 'yes' : 'no' ) .'<br><br>

   === Intervals (public)<br>

   Global public: ' . $api['global_public'] / 1000 . ' seconds.<br>
   Single public: ' . $api['single_public'] / 1000 . ' seconds.<br><br>

   === Intervals (private)<br>

   Global private: ' . $api['global_private'] / 1000 . ' seconds.<br>
   Single public: ' . $api['single_private'] / 1000 . ' seconds.
   ';
 }
?>
