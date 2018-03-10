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

$query = "SELECT * FROM " . $credentials['ptable'] . " ORDER BY date DESC LIMIT " . $row . ', ' . $amountpage;

// If the old PID isn't set, make it NULL so the conditional will return false.
$oldpid = (isset($_POST['oldpid']) ? $_POST['oldpid'] : NULL);

if ($amountpage == 1)
{
 $rows = $server->query($query)->fetch();
 require_once("includes/rowy.php");
}
else
{
 foreach ($server->query($query) as $rows)
 {
  include("includes/rowy.php");
 }
}
?>
