<?php
 require_once("config.php");
 echo "<html>
 <head>
  <title>$info[title]</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
  <link rel='stylesheet' href='https://bootswatch.com/4/cyborg/bootstrap.min.css'>
  <link rel='stylesheet' href='mod.css'>
 </head>
 <body>
  <div class='page-header'>
    <center><h1>$info[title]</h1></center>
  </div>
  ";
 if ( ! isset($_GET['request']))
 {
  foreach($server->query("SELECT * FROM " . $credentials["ptable"]) as $rows) {
   echo "<div class='card text-white bg-dark mb-2 mx-auto' style='max-width: 95%' >
   <div class='card-header'>$rows[date]</div>
   <div class='card-body'>$rows[cont]</div>
   <div class='card-footer'>Posted by ";

   if ((isset($rows['nick'])) && (empty($rows['nick']))) {
    echo "<i>Anonymous</i>";
   }
   else
   {
	echo "$rows[nick]";
   }
   echo "</div>
  </div>";
  }
 }
 else
 {
  if ($_GET['request'] == 'create')
  {
   if (isset($_POST['content']))
   {
	$rndn = rand();
    $block = $server->query("SELECT * FROM `" . $credentials["ptable"] . "` WHERE `pid` = '" . $rndn . "'");
    $count = $block->rowCount();
    if ($count > 0)
	{
     while ($count > 0)
	 {
      $rndn = rand();
      $block = $server->query("SELECT * FROM `" . $credentials["ptable"] . "` WHERE `pid` = '" . $rndn . "'");
      $count = $block->rowCount();
     }
    }
	$now = getdate();
	$server->query("INSERT INTO `" . $credentials['ptable'] . "` (`nick`, `date`, `pid`, `cont`, `rep`) VALUES (" . $server->quote($_POST['nick']) . ", '" . $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . "', '" . $rndn . "', " . $server->quote($_POST['content']) . ", 0)");
	header("location: index.php");
   }
   else
   {
   echo "
   <form method=post action='' >
    <div class='form-group mx-auto' style='max-width: 80%'>
	 <label for='post'>Post content</label>
	 <input type='text' class='form-control' id='content' name='content'>
	</div>
	<div class='form-group mx-auto' style='max-width: 80%'>
	 <label for='nick' style='max-width: 15%'>Nick</label>
	 <input type='text' class='form-control' id='nick' name='nick' style='max-width: 15%' maxlength=16>
    </div>
    <div class='container-fluid sticky-bottom' style='max-width: 80%'>
     <button type='submit' class='btn float-right bg-success'>Submit</button>
    </div>
   </form>
   ";
   }
  }
 }
 echo "
  <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
 ";
 if (( ! isset($_GET['request'])) || ( ! $_GET['request'] == 'create'))
 {
  echo "
  <div class='container-fluid sticky-bottom'>
   <form method=get action='' >
    <input name='request' id='request' type=hidden value='create'>
    <button class='btn float-right'>Create post</button>
   </form>
  </div>
  ";
 }
 echo "
 </body>
</html>
";
?>