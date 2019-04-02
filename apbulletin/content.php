<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
<style>
  * {
    line-height: 1.5;
  }
</style>
<table id="structure">
    <tr>
      <td id="navigation">
        <?php echo navigation($sel_subject, $sel_page) ;  ?>
        <a href="new_subject.php">+ Add a new subject</a><br>
        <a href="ap-admin.php">+ Return to Menu</a>
        <?php 
            if($_SESSION['role_id'] == EDITOR){
              echo '
                  <div style="display:none; background-color: none; border: 1px solid white; padding: 5px; margin-top: 10px; font-size:12px;">
                  <form action="includes/upload.php" method="POST" enctype="multipart/form-data">
                    + Upload Logo:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <hr>
                    <input type="submit" value="Upload Image" name="submit" class="btn btn-default" style="color:whitesmoke; background-color: black; text-decoration: none; width: 100px;">
                  </form>
                  <?php
                    if(!empty($msg)){
                      echo $msg;
                    }
                  ?>
                </div>
              ';
            }else{
              echo '
              <div style="background-color: none; border: 1px solid white; padding: 5px; margin-top: 10px; font-size:12px;">
              <form action="includes/upload.php" method="POST" enctype="multipart/form-data">
                + Upload Logo:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <hr>
                <input type="submit" value="Upload Image" name="submit" class="btn btn-default" style="color:whitesmoke; background-color: black; text-decoration: none; width: 100px;">
              </form>
              <?php
                if(!empty($msg)){
                  echo $msg;
                }
              ?>
            </div>
                ';
            } 
          ?>
      </td>
      <td id="page" style="padding-right:15px;">
        <?php if(!is_null($sel_subject)) { // subject selected ?>
        <h2><?php echo htmlentities($sel_subject["menu_name"]) ;?></h2>
        <?php } elseif (!is_null($sel_page)) { // page selected ?>
            <h2><?php echo htmlentities($sel_page["menu_name"]); ?></h2>
            <div class = "page-content">
              <?php // echo  strip_tags(nl2br($sel_page["content"]), "<b><br><p><a><hr><i><u><h1><h2><h3><h4><h5><h6><center>" ) ;?>
              <?php 
                //echo strip_tags(nl2br($sel_page["content"]), "<b><br><p><a><hr><i><u><h1><h2><h3><h4><h5><h6><center>");
                function get_img($public = true){
                  global $connection;
                  $sql = "SELECT * FROM pages WHERE id = {$_GET['page']}";
                  $result = mysql_query($sql);
                  confirm_query($result);
                  return($result);
                }

                function get_ad($public = true){
                  global $connection;
                  $sql = "SELECT * FROM adverts WHERE page = {$_GET['page']}";
                  $result = mysql_query($sql);
                  confirm_query($result);
                  return($result);
                }
                
                $result = get_img();
                if($result){
                  while ($row = mysql_fetch_array($result)) {
                    $pics = $row['7'];
                  }
                }

                if(empty($pics)){
                  
                }else{ 
                  echo "<img src='".$pics."' style='float: left; max-width:150px; height:200px; padding-right:15px;'>";
                }
                echo $sel_page["content"];
              ?>
              <?php echo  $sel_page["content"] ;?>
            </div>
            <br/>
            <hr>
            <a href="edit_page.php?page=<?php 
                      echo urlencode($sel_page['id']);
                      ?>
                    ">Edit page</a>
       <?php } else{ // nothing was selected ?>
         <h2> Select a subject / page to edit </h2>
       <?php }?>
      </td>
      <td>
        <div style="border: 1px solid black; padding:5px; height:100%; background-color:grey;">
          <h3 style="padding-left:5px; border:none; border-left: 3px solid green; background-color: whitesmoke; margin-top:0px;">Advertisments/Announcement</h3>
          <?php
            if(isset($_GET['page'])){
              $result_ad = get_ad();
              if($result_ad){
                while ($row = mysql_fetch_array($result_ad)){
                  echo'
                      <hr><h3 style="border:none; border-left:3px solid green; padding:3px; margin-top:0px;">'.$row['2'].'</h4>
                      <img src="'.$row['4'].'"style="float:left; margin-top:-12px; margin-right:10px; max-width:100px; height:100px;">
                      <p style="text-align:justify;">'.$row['3'].'</p>
                    ';
                }
              }
            }
          ?>
          </div>
      </td>
    </tr>
  </table>
<?php require("includes/footer.php");?>
