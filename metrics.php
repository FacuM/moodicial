<?php
 if ($metrics)
 {
  if ($metricsset['visits'] == 'yes')
  {
   $visits = 0;
   foreach($server->query("SELECT * FROM `" . $credentials['mtable'] . "` WHERE `id` = 0") as $metrics)
   {
     $visits = $visits + $metrics['amount'];
   }
   // If Infinite Scroll isn't running, update the amount of visits.
   if (( ! isset($_GET['p'])) || $_GET['p'] < 1 )
   {
     $server->query("UPDATE `" . $credentials['mtable'] . "` SET `amount`=amount+1 WHERE `id` = 0");
   }
  }
 }
?>
