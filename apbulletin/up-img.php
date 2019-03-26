<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

    $target_dir = "includes/imgs/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $page = $_GET['page'];
    
    function upload_logo($target,$page){
        global $connection;
        $sql= "UPDATE pages SET image ='{$target}' WHERE id = {$page}";
        $result= mysql_query($sql);
        confirm_query($result);
        return($result);
    }

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
            $msg = "Upload Was Successful";
        } else {
            $uploadOk = 0;
            $msg = "The File is not an image";
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 1;
        $msg = "The Image File Is already uploaded";
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        $uploadOk = 0;
        $msg = "The Image File is too Large";
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $uploadOk = 0;
        $msg = "The File Type is invalid";
    }

    // Check if $uploadOk is set to  0 by an error
    if ($uploadOk == 0) {
        $msg = "Something went wrong, Image was not uploaded";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $result = upload_logo($target_file,$page);
            if(!empty($result)){
                $msg = "Image was uploaded successfully";
                redirect_to('content.php');
            }
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            $msg = "There was an error Uploading the file";
        }
    }
    $_COOKIE['msg'] = $msg;
?>
