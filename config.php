<?php
 // This array saves the website information
 $info = array (
  'title'			=> 'Moodicial'
 );

 // This array saves the website credentials.
 $credentials = array (
  'hostname'     => '127.0.0.1',
  'port'         => '3306',
  'username'     => 'root',
  'password'     => '',
  'db'           => 'moodicial',
  'ptable'       => 'moodicial_posts',
  'ctable'       => 'moodicial_comments',
  'mtable'       => 'moodicial_metrics',
  'btable'       => 'moodicial_banned'
 );

 // Maintenance mode?
 $maintenance = false;

 // Whether to enable or not automatic language switch. Type 'auto' for automatic or any language for manual (options are'es_LA', 'en_US' and everything in "lang").
 $language = 'auto';
 // Show language badge?
 $langbadge = true;

 // Server document root. Set this to the path to your website files, omitting the root dir. If you put them in '/var/www/moodicial' write just '/moodicial'.
 $path = '';
 // Should people be able to report?
 $reports = true;
 // Enable thumbsmod?
 $thumbsmod = true;
 // Max amount of reports
 $maxrep = 5;
 // Allow empty posts? (without text)
 $allowempty = false;
 // Allow uploading local sources?
 $allowuploads = true;
 // Work without internet? (set this to 'true' if you aren't gonna connect your installation to a public network).
 $nointernet = false;
 // Allow administrators to ban users?
 $allowbans = true;

 // Enable metrics?
 $metrics = true;
 // What should we track?
 $metricsset = array (
   'visits'      => 'yes'
 );

 $api = array (
   // Enable the API?
   'enable'             => true,
   // Interval for global public requests.
   'global_public'      => 3600000,
   // Interval for per-post public requests.
   'single_public'      => 60000,
   // Interval for global protected requests.
   'global_private'     => 0,
   // Interval for per-post protected requests.
   'single_private'     => 0,
   // Passphrase for protected requests.
   'key_private'        => 'admin'
 );

 // => Client-side scripting settings (time values measured in milliseconds)

 // Amount of items to fill with by default.
 $amountpage = 10;
 // Offset from viewport end before trying to load more content.
 $offset = 1000;
 // Default animations duration.
 $atime = 2000;
 // Seconday animations duration.
 $atimeb = 750;
 // Dynamic load interval.
 $dynloadint = 2500;
 // Max time a request should take before showing an alert.
 $maxload = 5000;
 // Minimum time between user interactions (0 for none).
 $throttletime = 10000;

 // From now on, don't edit anything as you could break the whole website.


 // Set the URL that would point to the root of the server and hold the index.
 $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'] . $path;

 // We aren't normally getting single posts.
 $noformat = false;

 // Set the path for the third party content.
 $tpdir = (empty($path) ? "thirdparty" : $path . "/thirdparty");

 // Create the PDO object for the MySQL server connection.
  try {
   $server = new PDO('mysql:host=' . $credentials['hostname'] . ';port=' . $credentials['port'] . ';dbname=' . $credentials['db'] . ';charset=utf8', $credentials['username'], $credentials['password']);
  } catch (\Exception $errcondb) {
   try {
   $server = new PDO('mysql:host=' . $credentials['hostname'] . ';port=' . $credentials['port'] . ';charset=utf8', $credentials['username'], $credentials['password']);
   $server->query("CREATE DATABASE " . $credentials['db']);
   header("location: " . $root . "/install.php");
   } catch (\Exception $errcon) {
    die("The connection to the SQL server is totally broken, please double check your settings in 'config.php'.");
   }
  }

  // Start measuring the page generation time;
  $stime = microtime(true);

 // Minimum amount of strings to consider a language up-to-date.
 $minstr = 67;

 $ban = $server->query('SELECT * FROM ' . $credentials['btable'] . ' WHERE ip = ' . $server->quote($_SERVER['REMOTE_ADDR']))->fetch();
 if (!empty($ban))
 {
  $banned = true;
 }
 else
 {
  $banned = false;
 }
?>
