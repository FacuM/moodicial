<?php
 require_once("config.php");
 require_once("head.php");
 require_once("beginning.php");
 loadscripts();
 if (isset($_GET['nodb']) && $_GET['nodb'])
 {
  echo "<div class='alert alert-secondary mx-auto'> Hey, it looks like you totally missed creating the database before trying to install the website. But don't feel bad, I did it for you!</div>";
  $server->query("CREATE DATABASE " . $credentials['db']);
  echo "<div class='alert alert-success mx-auto'>Successfully created database <b>" . $credentials['db'] . "</b>.</div>";
 }
 else {
  echo "<div class='alert alert-primary mx-auto'>Connecting to the database...</div>";
  try
  {
   $server = new PDO('mysql:host=' . $credentials['hostname'] . ':' . $credentials['port'] . ';dbname=' . $credentials['db'] . ';charset=utf8', $credentials['username'], $credentials['password']);
  }
  catch(PDOException $err)
  {
   echo "<div class='alert alert-danger mx-auto'>Something went wrong, please check your configuration in 'config.php'.<br><br><b>" . $err. "</b></div>";
  }
  if ( ! isset($err))
  {
   echo "<div class='alert alert-success mx-auto'>Done. Connection successful!</div>";
  }
 }
  echo "<div class='alert alert-primary mx-auto'>Creating the database...</div>";
  $server->query("CREATE DATABASE " . $credentials['db']);
  echo "<div class='alert alert-success mx-auto'>Done. Database <b>" . $credentials['db'] . "</b> successfully created.</div>";
  echo "<div class='alert alert-primary mx-auto'>Creating the comments table.</div>";
  $server->query("CREATE TABLE `" . $credentials['ctable'] . "` (`nick` varchar(16) NOT NULL, `date` datetime NOT NULL, `pid` text NOT NULL, `cont` text NOT NULL, `rep` int(1) NOT NULL, `img` text NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>Created table <b>" . $credentials['ctable'] . "</b> for <b>comments</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>Creating the posts table.</div>";
  $server->query("CREATE TABLE `" . $credentials['ptable'] . "` (`nick` varchar(16) NOT NULL, `date` datetime NOT NULL, `pid` text NOT NULL, `cont` text NOT NULL, `rep` int(1) NOT NULL, `img` text NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>Created table <b>" . $credentials['ptable'] . "</b> for <b>posts</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>Creating the metrics table.</div>";
  $server->query("CREATE TABLE `" . $credentials['mtable'] . "` (`id` int(1) NOT NULL, `amount` BIGINT NOT NULL)");
  echo "<div class='alert alert-success mx-auto'>Created table <b>" . $credentials['mtable'] . "</b> for <b>metrics</b>.</div>";
  echo "<div class='alert alert-primary mx-auto'>Creating the visits entry on <b>" . $credentials['mtable'] . "</b></div>";
  $server->query("INSERT INTO `" . $credentials['mtable'] . "` (`id`, `amount`) VALUES ('0', '0')");
  echo "<div class='alert alert-success mx-auto'>Created entry for visits.</div>";
  echo "
  <br>
  <br>
  <div class='alert alert-info mx-auto'>Great job! It seems like everything works ;). Would you like <a href='" . $root . "'>try your site now?</a></div>";
require_once("footer.php");
?>
