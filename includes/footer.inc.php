<?php 
if (!defined('PWD')){
    exit('Access denied');
}
mysqli_close($conn);
?>
<div id="footer">
<p>help</p>
<p>payback</p>
<p>this web use:<?php echo round((runtime()-$starttime),4)?>seconds;
</div>
