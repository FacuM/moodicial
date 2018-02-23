<?php
 // This array saves the website information
 $info = array (
  'title'			=> 'Moodicial'
 );
 
 // This array saves the website credentials.
 $credentials = array (
  'hostname'		=> '127.0.0.1',
  'port'				   => '3306',
  'username'		=> 'root',
  'password'		=> '',
  'db'					  => 'moodicial',
  'ptable' 	          => 'moodicial_posts',
 );
 
 // Max amount of reports
 $maxrep = 5;
 // Server document root. Set this to the path to your website files, omitting the root dir. If you put them in '/var/www/moodicial' write just '/moodicial'.
 $path= '/moodicial';
 
 // From now on, don't edit anything as you could break the whole website.
 
 // Create the PDO objet for the MySQL server connection.
 $server = new PDO('mysql:host=' . $credentials['hostname'] . ':' . $credentials['port'] . ';dbname=' . $credentials['db'] . ';charset=utf8', $credentials['username'], $credentials['password']);
 // Set the URL that would point to the root of the server and hold the index.
 $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . $path;
?>