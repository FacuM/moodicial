<?php
 require_once("config.php");
 // Simple jQuery powered admin console backend.
 if (isset($_POST['query']) && empty($_POST['query']))
 {
  die('Unable to handle request: no query supplied.');
 }
 else
 {
  if (isset($_POST['password']) && $_POST['password'] == $credentials['password'])
  {
	$query = $server->query($_POST['query']);
	if (is_object($query))
	{
	 echo 'Success handling your query: "' . $_POST['query'] . '".';
     foreach($query as $data)
     {
      print_r($data);
     }
	}
	else
	{
     die('Unable to handle request: failed to process your query.');
	}
  }
  else
  {
   die('Unable to handle request: wrong password.');
  }
 }
?>
