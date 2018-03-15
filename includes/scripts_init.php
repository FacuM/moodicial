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
     var root = '" . $root . "';
     var no_nick = '" . $LANG['no_nick'] . "';
     var comment_after_nick = '" . $LANG['comment_after_nick'] . "';
     var alt_broken_image = '" . $LANG['alt_broken_image'] . "';

     // If the image isn't reachable, replace it with a text regarding that.

     function imgerr(pid)
     {
      // Make an object of the broken element
      var broken = $('#' + pid);
      broken.find('img').replaceWith('<small>' + img_unreachable + '</small>');
     };
  </script>
 ";
?>
