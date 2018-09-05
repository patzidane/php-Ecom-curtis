<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/tutorial/core/init.php';
$parentID = (int)$_POST['parentID'];
$childQuery = $db->query("SELECT * FROM categories WHERE patent = '$parentID' ORDER BY category");
ob_start();

?>
<option value=""></option>
<? while($child = mysqli_fetch_assoc($childQuery)):?>
<option value="<?=$child['id'];?>"><?=$child['category']''?></option>
<? endwhile;?>
<?
echo ob_get_clean();
?>
