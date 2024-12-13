<?php
include 'database.php';
ob_start(); 
$title = "Accueil";
?>

<?php
$content = ob_get_clean(); 
include 'design.php'; 

?>
