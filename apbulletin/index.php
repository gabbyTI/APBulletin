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
      <td id="page" style="">
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
          }else{
            echo $sel_page["content"];
          }
        ?>
        </div>
        <?php } else{ ?>
		 <!-- sl-slider Container -->
		<div class="demo-2" style="width:100%">
        <!-- sl-slider wrapper -->
        <div id="slider" class="sl-slider-wrapper" style="width:100%">
            <!-- sl-slider  -->
            <div class="sl-slider">

                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-1"></div>
                        <h2>Salvation is important.</h2>
                        <blockquote>
                            <p>Don't Be Left Out.</p>
                        </blockquote>
                    </div>
                </div>

                <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-2"></div>
                        <h2>Be proud of Christianity 100%</h2>
                        <blockquote>
                            <p>confidence in the Lord.</p>
                        </blockquote>
                    </div>
                </div>

                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-3"></div>
                        <h2>Anthoopadua Bulletin</h2>
                        <blockquote>
                            <p>Giving the best Services</p>
                        </blockquote>
                    </div>
                </div>

                <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                        <div class="bg-img bg-img-4"></div>
                        <h2>Guaranteed premium services</h2>
                        <blockquote>
                            <p>Online Catholic bulletines and magazines</p>
                        </blockquote>
                    </div>
                </div>

            </div>
            <!-- /sl-slider -->

            <!-- sl-slider Nav -->
            <nav id="nav-arrows" class="nav-arrows">
                <span class="nav-arrow-prev">Previous</span>
                <span class="nav-arrow-next">Next</span>
            </nav>
            <nav id="nav-dots" class="nav-dots">
                <span class="nav-dot-current"></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </nav>
            <!-- /sl-slider Nav -->
        </div>
        <!-- /sl-slider Wrapper -->
    </div>
    <!-- /sl-slider Container -->

    <!-- <h2> Welcome to A. A. Mortins</h2> -->
       <?php }?>
      </td>
      <td id="navigation">
        <?php
          if(isset($_GET['page']) || isset($_GET['subj'])){
            $visible = 'block';
          }else{
            $visible = 'none';
          }
        ?>
        <div style="border: 1px solid black; padding:5px; display:<?php echo $visible;?>; height:100%; background-color:grey;">
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
<script type="text/javascript" src="assets/slslider/js/jquery.ba-cond.min.js"></script>
<script type="text/javascript" src="assets/slslider/js/jquery.slitslider.js"></script>