<?php
 echo
 "
  <script>
     var amountpage = " . $amountpage . ";
     var offset = " . $offset . ";
     var atime = " . $atime . ";
     var atimeb = " . $atimeb . ";
     var dynloadint = " . $dynloadint . ";
     var hint = '" . $LANG['langbadge_hint'] . "';
     var maxrep = " . $maxrep . ";
     var ui_loading = '" . $LANG['ui_loading'] . "';
     var submit = '" . $LANG['forms_button_submit'] . "';
     var server_lag = '" . $LANG['server_lag'] . "';
     var server_err = '" . $LANG['server_err'] . "';
     var maxload = " . $maxload . ";
     var rate_limited = '" . $LANG['rate_limited'] . "';
     var rate_limited_sm = '" . $LANG['rate_limited_sm'] . "';
     var throttletime = " . $throttletime . ";
     var img_unreachable = '" . $LANG['img_unreachable'] . "';
     var maintenance = " . ($maintenance ? 'true' : 'false') . ";

     // If the image isn't reachable, replace it with a text regarding that.

     function imgerr(pid)
     {
      // Make an object of the broken element
      var broken = $('#' + pid);
      broken.find('img').replaceWith('<small>' + img_unreachable + '</small>');
     };
	 
	 console.log(\"Are you human, potato or administrator? Run a SQL query by typing as follows: \\n\\n\\nadmin('query', 'database password');\\n\\ni.e: \\nadmin('SELECT * FROM moodicial_posts', 'admin');\\n\\nYou'll receive the response here.\");
  </script>
 ";
?>
