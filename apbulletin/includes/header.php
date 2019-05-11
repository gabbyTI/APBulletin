<?php require_once "functions.php";?>
<?php require_once "includes/session.php";?>
<?php require_once "includes/connection.php";?>
<!DOCTYPE html>
<html>

    <head>
        <title>KK Motins</title>
        <!-- Sl Slider -->
		<link rel="stylesheet" type="text/css" href="./assets/slslider/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="./assets/slslider/css/style.css" />
		<link rel="stylesheet" type="text/css" href="./assets/slslider/css/custom.css" />
		<noscript>
			<link rel="stylesheet" type="text/css" href="./assets/slslider/css/styleNoJS.css" />
    </noscript>
    
    <link href="styles/apstyles.css" media="all" rel="stylesheet" type="text/css">
		
		

		<script src="./assets/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="./assets/slslider/js/modernizr.custom.79639.js"></script>
		<script src="ckeditor/ckeditorf/ckeditor.js"></script>
    </head>

    <body>
        <div id="header">
            <?php
$result = get_logo();
if ($result) {
    while ($row = mysql_fetch_array($result)) {
        $pics = $row['logo'];
    }
}
if (empty($pics)) {
    echo "<h1>KK Motins</h1>";
} else {
    echo '
          <table id="structure">
            <tr>
              <td>
                <a href="index.php"><img src="includes/' . $pics . '" style="border-radius:10px; margin-left: 50px; margin-top: 5px; width:60px; height:60px;" alt="user-profile-picture"/></a>
              </td>
              <td>
                <h1><a href="index.php" style="text-decoration:none; color:whitesmoke; font-size:17px;">Home</a></h1>
              </td>
              <td>
                <h1>Pilgrimage Center Elele</h1>
              </td>
              <td>
                <h1>' . date("F Y") . '</h1>
              </td>
            </tr>
          </table>';
}
?>
            <!-- <img src="logos/Chib Sch 20170915_225715.jpg" style="width:100px; height:100px;" alt="user-profile-picture"/> -->
        </div>
        <div id="main">