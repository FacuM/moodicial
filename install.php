<?php
 require_once("config.php");
 require_once("head.php");
 require_once("beginning.php");
 loadscripts();
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
 echo "<div class='alert alert-primary mx-auto'>Creating the database...</div>";
 $server->query("CREATE DATABASE " . $credentials['db']);
 echo "<div class='alert alert-success mx-auto'>Done. Database <b>" . $credentials['db'] . "</b> successfully created.</div>";
 echo "<div class='alert alert-primary mx-auto'>Creating the comments table.</div>";
 $server->query("CREATE TABLE `" . $credentials['ctable'] . "` (`pid` text NOT NULL,`data` text NOT NULL)");
 echo "<div class='alert alert-success mx-auto'>Created table <b>" . $credentials['ctable'] . "</b> for <b>comments</b>.</div>";
 echo "<div class='alert alert-primary mx-auto'>Creating the posts table.</div>";
 $server->query("CREATE TABLE `" . $credentials['ptable'] . "` (`nick` varchar(16) NOT NULL, `date` datetime NOT NULL, `pid` text NOT NULL, `cont` varchar(2500) NOT NULL, `rep` int(1) NOT NULL)");
 echo "<div class='alert alert-success mx-auto'>Created table <b>" . $credentials['ptable'] . "</b> for <b>posts</b>.</div>";
 echo "
 <br>
 <br>
 <div class='alert alert-info mx-auto'>Great job! It seems like everything works ;). Would you like <a href='" . $root . "'>try your site now?</a></div>";
 require_once("footer.php");
?>