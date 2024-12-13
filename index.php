<?php
include 'database.php';
ob_start(); 
?>

<?php
$content = ob_get_clean(); 
include 'design.php'; 
?>
