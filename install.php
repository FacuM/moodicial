<?php
 require_once("config.php");
 require_once("beginning.php");
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_connecting'] . "</div>";
  try
  {
   $server = new PDO('mysql:host=' . $credentials['hostname'] . ';port=' . $credentials['port'] . ';dbname=' . $credentials['db'] . ';charset=utf8', $credentials['username'], $credentials['password']);
  }
  catch(PDOException $err)
  {
   echo "<div class='alert alert-danger mx-auto'>" . $LANG['installer_db_err'] . "'config.php'.<br><br><b>" . $err. "</b></div>";
  }
  if ( ! isset($err))
  {
   echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_connect_ok'] . "</div>";
  }
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_creating'] . "</div>";
  $server->query("CREATE DATABASE " . $credentials['db']);
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_creation_ok'] . "</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_c_ctable'] . "</div>";
  $server->query("CREATE TABLE `" . $credentials['ctable'] . "` (`nick` varchar(16) NOT NULL, `date` datetime NOT NULL, `pid` text NOT NULL, `cont` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `img` text NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_c_table_ok'] . "<b>" . $credentials['ctable'] . "</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_c_ptable'] . "</div>";
  $server->query("CREATE TABLE `" . $credentials['ptable'] . "` (`nick` varchar(16) NOT NULL, `date` datetime NOT NULL, `pid` text NOT NULL, `cont` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `rep` int(1) NOT NULL, `img` text NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_c_table_ok'] ."<b>" . $credentials['ptable'] . "</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_db_c_mtable'] . "</div>";
  $server->query("CREATE TABLE `" . $credentials['mtable'] . "` (`id` int(1) NOT NULL, `amount` BIGINT NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_db_c_table_ok'] . "<b>" . $credentials['mtable'] . "</b>.</div>";
  $server->query("TRUNCATE " . $credentials['mtable']);
  echo "<div class='alert alert-secondary mx-auto'>" . $LANG['installer_metrics_cleanup'] . "<b>" . $credentials['mtable'] . "</b></div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_metrics_visits'] . "<b>" . $credentials['mtable'] . "</b></div>";
  $server->query("INSERT INTO `" . $credentials['mtable'] . "` (`id`, `amount`) VALUES ('0', '0')");
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_metrics_ok'] . "</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_fol_mk'] . "</div>";
  if (!file_exists("thirdparty"))
  {
   mkdir($tpdir, 0777, true);
  }
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_fol_ok_a'] . "<b>" . $tpdir . "</b>" . $LANG['installer_fol_ok_b'] . "</div>";
  echo "<div class='alert alert-primary mx-auto'>" . $LANG['installer_dl_extras'] . "</div>";
  file_put_contents($tpdir . "/jquery-3.3.1.min.js", file_get_contents('https://code.jquery.com/jquery-3.3.1.min.js'));
  file_put_contents($tpdir . "/bootstrap_cyborg.min.css", file_get_contents('https://bootswatch.com/4/cyborg/bootstrap.min.css'));
  file_put_contents($tpdir . "/bootstrap.min.css", file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'));
  file_put_contents($tpdir . "/octicons.min.css", file_get_contents('https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.min.css'));
  file_put_contents($tpdir . "/popper.min.js", file_get_contents('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'));
  file_put_contents($tpdir . "/bootstrap.min.js", file_get_contents('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'));
  file_put_contents($tpdir . "/opensans.css", file_get_contents('https://fonts.googleapis.com/css?family=Open+Sans'));
  echo "<div class='alert alert-success mx-auto'>" . $LANG['installer_dl_ok'] . "</div>";
  echo "
  <br>
  <br>
  <div class='alert alert-info mx-auto'>" . $LANG['installer_success_a'] . "<a href='" . $root . "'>" . $LANG['installer_success_b'] . "</a></div>";
require_once("footer.php");
?>
