<?php
echo "<noscript>
<div class='pager mx-auto text-center'>";
// ridb = row id beginning, ride = row id end
$ridb = (isset($_GET['ridb']) ? (int)$_GET['ridb'] : 0);
$ride = (isset($_GET['ride']) ? (int)$_GET['ride'] : $amountpage);
if ($ridb <= $amount)
{
  if ($ridb > 0)
  {
    echo "<a class='btn btn-primary pager-btns-l' href='?ridb=" . ($ridb - $amountpage) . "&ride=" . ($ride - $ridb) .
    "'><span class='octicon octicon-triangle-left'>Previous</span></a>";
  }
  echo "<a class='btn btn-primary pager-btns-r' href='?ridb=" . ($ridb + $amountpage) . "&ride=" . ($ridb == 0 ? ($ride + $amountpage) : ($ride + $ridb)) .
  "'><span class='octicon octicon-triangle-right'>Next</span></a>
  "
  ;
}
else
{
  echo "<div class='alert alert-light mx-auto'>" . $LANG['nojs_nocontent_a'] . " <a href='" . $root . "/main.php'>" . $LANG['nojs_nocontent_b'] . "</a></div>";
}
echo "
</div>
</noscript>"
;
?>
