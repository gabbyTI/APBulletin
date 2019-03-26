<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
  // make sure the page id sent is an integer
  if(intval($_GET['page']) == 0){
    redirect_to("content.php");
  }

  include_once("includes/form_functions.php");

  // START FORM PROCESSING
  // only execute the form processing if the form has been submitted
  if (isset($_POST['submit'])) {
    // initialize an array to hold our errors
    $errors = array();

  // perform validations on the form data
  $required_fields = array('menu_name', 'position', 'visible', 'date_published', 'content');
   $errors = array_merge($errors, check_required_fields($required_fields));

  $fields_with_lengths = array('menu_name' => 50);
  $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));

  // Database submission only proceeds if there were NO errors
  if (empty($errors)) {

  // Clean up the form data before putting it in database
    $id = mysql_prep($_GET['page']);
    $menu_name = mysql_prep($_POST['menu_name']);
    $position = mysql_prep($_POST['position']);
    $visible = mysql_prep($_POST['visible']);
    $date_published = mysql_prep($_POST['date_published']);
    $content = mysql_prep($_POST['content']);

    $query = "UPDATE pages SET 
                menu_name = '{$menu_name}', 
                position = {$position},
                visible = {$visible},
                dop = '{$date_published}',
                content = '{$content}'
              WHERE id = {$id}";
    $result = mysql_query($query, $connection);
    // test to see if the update occurred
    if (mysql_affected_rows() == 1) {
      // Success!
      $message = "The page was successfully updated.";
    } else{
      // Failed
      $message = "The page updated failed";
      $message .= "<br/>" . mysql_error();
    }
  
  } else{   // else of: if (empty($errors))
    // Errors occurred
    if (count($errors) == 1) {
      $message = "There was 1 error in the form.";
    } else{
      $message = "There were " . count($errors) . "errors in the form.";
    }

  } // end of: if (empty($errors))

  } // end:if(isset($_POST['submit'])).Currently there it has no "Else"
?>
<?php find_selected_page(); ?>
<?php include("includes/header.php"); ?>
  <table id="structure">
    <tr>
      <td id="navigation">
        <?php echo navigation($sel_subject, $sel_page); ?>
        <br />
        <a href="new_subject.php">+ Add a new subject</a>
      </td>
      <td id="page">
        <h2>Edit Page: <?php echo htmlentities($sel_page['menu_name']) ; ?></h2>
        <?php if (!empty($message)) {
                echo "<span class=\"message\">" . $message . "</span>";
        } ?>
        <?php
        // Using function to list he fields that had errore
        if (!empty($errors)) { display_errors($errors); }
        ?>
        <?php 
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
                  echo "<img src='".$pics."' style='float: right; margin-top:-40px; max-width:150px; height:200px; padding-right:15px;'>";
                }
              ?>
        <form action="up-img.php?page=<?php echo $_GET['page'];?>" method="POST" enctype="multipart/form-data">
          + Upload Logo:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="upload" class="btn btn-default" style="color:whitesmoke; background-color: black; text-decoration: none; width: 100px;">
        </form>
        <form action="edit_page.php?page=<?php 
                    echo urlencode($sel_page["id"]); 
                    ?>" method="POST">
          
          <?php include "page_form.php"; ?>
          
          <input type="submit" name="submit" value="Update page" />
          &nbsp;&nbsp;
          
          <a href="delete_page.php?page=<?php
            echo urlencode($sel_page["id"]) ; ?>
          " onclick="return confirm('Are you sure');">Delete Page</a>
        
        </form>
        
        <a href="content.php">Cancel</a>
      </td>
    </tr>
  </table>
  
<?php require("includes/footer.php");?>
