<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php"); ?>
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
        <?php echo public_navigation($sel_subject, $sel_page) ;  ?>
      </td>
      <td id="page">
        <?php if($sel_page) { ?>
        <h2><?php echo htmlentities($sel_page["menu_name"]);?></h2>
        <div class = "page-content">
        <?php 
          if(isset($_GET['page'])){
            //echo strip_tags(nl2br($sel_page["content"]), "<b><br><p><a><hr><i><u><h1><h2><h3><h4><h5><h6><center>");
            function get_img($public = true){
              global $connection;
              $sql = "SELECT * FROM pages WHERE id = {$_GET['page']}";
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
              echo "<img src='' alt='No image' style='float: left; max-width:150px; height:200px; padding-right:15px;'>";
            }else{ 
              echo "<img src='".$pics."' style='float: left; max-width:150px; height:200px; padding-right:15px;'>";
            }
            echo $sel_page["content"];
          }else{
            echo $sel_page["content"];
          }
        ?>
        </div>
        <?php } else{ ?>
         <h2> Welcome to A. A. Mortins</h2>
       <?php }?>
      </td>
    </tr>
  </table>
<?php require("includes/footer.php");?>
