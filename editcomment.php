<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php include('includes/comments.inc.php'); ?>
<?php include('includes/head_section.php'); ?>

<?php date_default_timezone_set('Europe/Chisinau'); ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="container">
    	<!-- Navbar -->
    		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
    	<!-- // Navbar -->

      <?php
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];
      	echo "<form class='' action='".editComments($conn)."' method='post'>
      		<input type='hidden' name='cid' value='".$cid."'>
      		<input type='hidden' name='uid' value='".$uid."'>
      		<input type='hidden' name='date' value='".$date."'>
      		<textarea name='message' rows='8' cols='80'>".$message."</textarea> <br>
      		<button type = 'submit' name = 'commentSubmit'>Edit</button>
      	</form>";
      ?>
  </body>
</html>
