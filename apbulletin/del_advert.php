<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    $ad_id = $_POST['del_ad'];
    global $connection;
    $sql = "DELETE FROM adverts WHERE id = {$ad_id}";
    $result = mysql_query($sql);
    confirm_query($result);

    if($result){
        redirect_to('content.php');
    }
?>