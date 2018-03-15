<?php

// Take you back to the home (used for all errors).

echo '

<p>' . $LANG['ui_goback_adv'] . '</p>
<p class="lead">
 <a class="btn btn-primary btn-lg" href="#" onclick="delreload()" role="button">' . $LANG['ui_home'] . '</a>
 <noscript><a class="btn btn-primary btn-lg" href="' . $root . '" role="button">' . $LANG['ui_home'] . '</a></noscript>
</p>

';

?>
