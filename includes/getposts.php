<?php

$noformat = true;
require_once("head.php");
// Prepare the $row variable that'll be passed to the SQL query.
if (isset($_POST['row']))
{
 if ($_POST['row'] == 'new')
 {
  $row = 0;
 }
 else
 {
  $row = $_POST['row'];
 }
}
else
{
 $row = 0;
}

// Set up the query

$query = "SELECT * FROM " . $credentials['ptable'] . " ORDER BY date DESC LIMIT " . (isset($_GET['ridb']) ? (int)$_GET['ridb'] : $row) . ', ' . (isset($_GET['ride']) ? (int)$_GET['ride'] : $amountpage);

// If the old PID isn't set, make it NULL so the conditional will return false.
$oldpid = (isset($_POST['oldpid']) ? $_POST['oldpid'] : NULL);
$amount = $server->query("SELECT COUNT(pid) AS total FROM " . $credentials['ptable'])->fetch()['total'];
if ($amountpage == 1)
{
 if ($amount > $row)
 {
  $rows = $server->query($query)->fetch();
  include("includes/rowy.php");
  }
  else
  {
   die('');
  }
}
else
{
 foreach ($server->query($query) as $rows)
 {
  include("includes/rowy.php");
 }
}
?>
