<?php
include "lib/phpqrcode/qrlib.php"; 
 
$ID = $_GET['ID']; 
 
QRcode::png($ID); 
?>