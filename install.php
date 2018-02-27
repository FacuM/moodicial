<?php
 require_once("config.php");
 require_once("beginning.php");
 loadscripts();
 if (isset($_GET['nodb']) && $_GET['nodb'])
 {
  echo "<div class='alert alert-secondary mx-auto'>" . $LANG['installer_no_db'] . "</div>";
  $server->query("CREATE DATABASE " . $credentials['db']);
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_creation_ok'] . "<b>" . $credentials['db'] . "</b>.</div>";
 }
 else {
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_connecting'] . "</div>";
  try
  {
   $server = new PDO('mysql:host=' . $credentials['hostname'] . ':' . $credentials['port'] . ';dbname=' . $credentials['db'] . ';charset=utf8', $credentials['username'], $credentials['password']);
  }
  catch(PDOException $err)
  {
   echo "<div class='alert alert-danger mx-auto'>" . $LANG['installer_db_err'] . "'config.php'.<br><br><b>" . $err. "</b></div>";
  }
  if ( ! isset($err))
  {
   echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_connect_ok'] . "</div>";
  }
 }
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_creating'] . "</div>";
  $server->query("CREATE DATABASE " . $credentials['db']);
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_creation_ok'] . "</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_c_ctable'] . "</div>";
  $server->query("CREATE TABLE `" . $credentials['ctable'] . "` (`nick` varchar(16) NOT NULL, `date` datetime NOT NULL, `pid` text NOT NULL, `cont` text NOT NULL, `rep` int(1) NOT NULL, `img` text NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_c_table_ok'] . "<b>" . $credentials['ctable'] . "</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_c_ptable'] . "</div>";
  $server->query("CREATE TABLE `" . $credentials['ptable'] . "` (`nick` varchar(16) NOT NULL, `date` datetime NOT NULL, `pid` text NOT NULL, `cont` text NOT NULL, `rep` int(1) NOT NULL, `img` text NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_c_table_ok'] ."<b>" . $credentials['ptable'] . "</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_c_mtable'] . "</div>";
  $server->query("CREATE TABLE `" . $credentials['mtable'] . "` (`id` int(1) NOT NULL, `amount` BIGINT NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_c_table_ok'] . "<b>" . $credentials['mtable'] . "</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_metrics_visits'] . "<b>" . $credentials['mtable'] . "</b></div>";
  $server->query("INSERT INTO `" . $credentials['mtable'] . "` (`id`, `amount`) VALUES ('0', '0')");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_metrics_ok'] . "</div>";
  echo "
  <br>
  <br>
  <div class='alert alert-info mx-auto'>" . $LANG['installer_success_a'] . "<a href='" . $root . "'>" . $LANG['installer_success_b'] . "</a></div>";
require_once("footer.php");
?>
