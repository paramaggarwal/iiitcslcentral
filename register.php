<?php
session_start();
include("./includes/config.php");
 
if ( $_POST["user_login"] != '' )
{
$display_name = $_POST['display_name'];
$user_login = $_POST['user_login'];
$dob = $_POST['dob'];
$course = $_POST['course'];
$branch = $_POST['branch'];
$year = $_POST['year'];
$father_name = $_POST['father_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$user_email = $_POST['user_email'];


$sql_query = "INSERT INTO bb_users (display_name, user_nicename, user_login, dob, course, branch, year, father_name, address, phone, user_email) VALUES ('$display_name', '$user_login', '$user_login', '$dob', '$course', '$branch', '$year', '$father_name', '$address', '$phone', '$user_email')";

if (!mysql_query($sql_query,$con))
  {
  die('Error: ' . mysql_error());
  }

header("Location: http://www.iiitcslcentral.co.cc/profiles.php?rollno=" . $user_login);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Registration Page</title>
	<link href="./css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./js/scripts.js"></script>
	<script type="text/javascript">
		window.onload=function(){
			Nifty("div#box1,div#footer");
			Nifty("div#navbar","transparent");
		}
		animatedcollapse.addDiv('box1_content', 'fade=1')
		animatedcollapse.init()
	</script>
	
</head>

<body>

<?php include("./includes/header.php"); ?>

<div id="main" style="margin: auto;">
<?php
if($_SESSION['loginok'] == "ok" && $_SESSION['level'] == "4")
{
?>
	<div class="column" style="width:100%;">
		<div class="container" id="box1">
			<div class="title clickable visualIEFloatFix" id="box1_title" onmousedown="animatedcollapse.toggle('box1_content'); toggleDiv('box1_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box1_content_toggle"><IMG src="http://www.iiitcslcentral.co.cc/images/arrow_down_2.gif"></A></P>
				<H2>Register</H2>
			</div>
			<div class="content" id="box1_content" >
<form action="./register.php" method="post">
			<p><b>Name</b> : <input type="text" name="display_name" /></p>
			<p><b>Username</b> : <input type="text" name="user_login" />(Your Enrollment No.)</p>
			<p><b>Date of Birth</b> : <input type="text" name="dob" />(YYYY-MM-DD)</p>
			<p><b>Course</b> : <input type="radio" name="course" value="B. Tech">B. Tech<input type="radio" name="course" value="M. Tech">M. Tech</p>
			<p><b>Branch</b> : <input type="radio" name="branch" value="Electronics and Communication">Electronics and Communication<input type="radio" name="branch" value="Information Technology">Information Technology</p>
			<p><b>Year</b> : <input type="radio" name="year" value="1">1<input type="radio" name="year" value="2">2<input type="radio" name="year" value="3">3<input type="radio" name="year" value="4">4</p>
 			<p><b>Father's Name</b> : <input type="text" name="father_name" /></p>
			<p><b>Address</b> : <input type="text" name="address" /></p>
			<p><b>Phone</b> : <input type="text" name="phone" /></p>
			<p><b>Email</b> : <input type="text" name="user_email" /></p>
</form>
			</div>
		</div>
	</div>
<div class="spacer"></div>
<?php 
}
else
{
?>

<p align="center">This page does not exist. <a href="http://www.iiitcslcentral.co.cc/" >Home</a>.</p>

<?php
}
?>

</div>

<?php include("./includes/footer.php"); ?>

</body></html>