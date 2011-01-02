<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>
	<?php
		if( $_SESSION['loginok'] == "ok")
			echo "Welcome " . $_SESSION['name'];
		else
			echo "Communication Skills Lab - IIIT, Allahabad";
	?>
	</title>
	<link href="./css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./js/scripts.js"></script>
	<script type="text/javascript">

                function notifyLogin(loginStatus)
		{
			if(loginStatus == 0) {
				$("#Incorrect").html("Username or Password seems wrong.<br>Did you <a href='forgot.php'>forget your password</a>?");
			}
			else if(loginStatus == 1) {
				window.location = "http://www.iiitcslcentral.co.cc/";
			}
			else {
				$("#Incorrect").html("");
			}
		}
                    
                function notifyFeedback(feedbackStatus)
		{
			if(feedbackStatus == 0) {
				$("#FeedbackMessage").html("Oops! We couldn't get it.");
			}
			else if(feedbackStatus == 1){
				$("#FeedbackMessage").html("We got it. Thanks a lot!");
			}
			else {
				$("#FeedbackMessage").html("");
			}	
		}

                function notifyProfiles(Status_p)
		{
			if(Status_p == 0) {
				$("#SearchMessage").html("Oops. There is no one with that Roll No./Name on our records. Maybe you should try something else in the search term.");
			}
			else{
				var output = Status_p;
				var outputArray = new Array();
 
				if(output.charAt(0) == '*') {
					outputArray = output.split("*");
					var list = new String();
					var roll = new String();
					var name = new String();
 
					list = "More than one records have been found. Please select the one you want: <br>";
					for(var i=1; i<(outputArray.length-1); i++) {
					 	roll = outputArray[i];
						name = outputArray[i+1];
						i++;
						list += "<a href = 'profiles.php?rollno="+roll+"'> &bull; "+roll+" - "+name+"</a><br>";
					}
					$("#SearchMessage").html(list);
				}
				else {
					$("#SearchMessage").html("");
					window.location = "profiles.php?rollno="+Status_p;
				}
			}
		}


		$(document).ready(function(){
                        Nifty("div#box1,div#box2,div#box3,div#box4,div#box5,div#box6,div#box7,div#box8,div#footer");
			Nifty("div#navbar,div#notices","transparent");

                        $("#box1_title").click(function () { $("#box1_content").slideToggle("slow"); });
                        $("#box2_title").click(function () { $("#box2_content").slideToggle("slow"); });
                        $("#box3_title").click(function () { $("#box3_content").slideToggle("slow"); });
                        $("#box4_title").click(function () { $("#box4_content").slideToggle("slow"); });
                        $("#box5_title").click(function () { $("#box5_content").slideToggle("slow"); });
                        $("#box6_title").click(function () { $("#box6_content").slideToggle("slow"); });
                        $("#box7_title").click(function () { $("#box7_content").slideToggle("slow"); });
                        $("#box8_title").click(function () { $("#box8_content").slideToggle("slow"); });

                        $("input[value='Login']").click(function () {
                             var username = $("input[name='username']").val(); 
              		     var password = $("input[name='password']").val();
                            $.post("./includes/login.php", { username: username, password: password },
                                function(data){
                                   notifyLogin(data);
                                }
                             );
                        });

                        $("input[name='password']").keypress(function (e) {
                            if(e.which == 13) {
  	                          var username = $("input[name='username']").val(); 
              		          var password = $("input[name='password']").val();
                                  $.post("./includes/login.php", { username: username, password: password },
                                       function(data){
                                           notifyLogin(data);
                                       }
                                   );
                             }
                        });

                         $("input[name='password']").keypress(function (e) {
                                    kc = e.keyCode?e.keyCode:e.which;
                                    sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
                                    if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
  	                                 $("#Incorrect").html("Caps Lock is ON");
                                    else
                                         $("#Incorrect").html("");
                         });


                        $("input[value='Submit']").click(function () {
                             var feedback = $("#feedback_text").val(); 
              		     var email = $("input[name='email']").val();
                            $.post("./includes/feedback.php", { username: feedback, password: email },
                                function(data){
                                   notifyFeedback(data);
                                }
                             );
                        });


                        $("input[name='email']").keypress(function (e) {
                             if(e.which == 13) {
  	                             var feedback = $("#feedback_text").val(); 
              		             var email = $("input[name='email']").val();
                                     $.post("./includes/feedback.php", { username: feedback, password: email },
                                           function(data){
                                              notifyFeedback(data);
                                            }
                                      );
                              }
                         });

                        $("input[value='Search']").click(function () {
                             var rollno = $("input[name='rollno']").val();
                            $.post("./includes/profilesearch.php", { rollno: rollno },
                                function(data){
                                   notifyProfiles(data);
                                }
                             );
                        });
                        
                        $("input[name='rollno']").keypress(function (e) {
                            if(e.which == 13) {
  	                          var rollno = $("input[name='rollno']").val();
                                  $.post("./includes/profilesearch.php", { rollno: rollno },
                                     function(data){
                                        notifyProfiles(data);
                                      }
                                   );
                             }
                        });



                });
	</script>
	
</head>

<body>

<?php include("./includes/header.php"); ?>

<div id="main">
	<div class="column">
		<div class="container" id="box1">
			<div class="title clickable visualIEFloatFix" id="box1_title" onmousedown="toggleDiv('box1_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box1_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Chit-Chat Updates</H2>
			</div>
			<div class="content" id="box1_content" >
				<?php include("./includes/recentposts.php"); ?>
			</div>     
		</div>
<?php
	if( $_SESSION['loginok'] == "ok")
	{
?>
		<div class="container" id="box2">
			<div class="title clickable visualIEFloatFix" id="box2_title" onmousedown="toggleDiv('box2_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box2_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2><?php echo $_SESSION['name']; ?>'s Profile</H2>
			</div>
			<div class="content" id="box2_content" >
				<?php include("./includes/myprofile.php"); ?>
			</div>
		</div>
         
<?php
	}
	else
	{
?>
		<div class="container" id="box2">
			<div class="title clickable visualIEFloatFix" id="box2_title" onmousedown="toggleDiv('box2_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box2_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>About CSL</H2>
			</div>
			<div class="content" id="box2_content" >
				<b>Communication Skills Lab</b>
				<?php include("./about/about.php"); ?>
			</div>
  		</div>
<?php
	}
?>
	</div>
        
	<div class="column">
<?php
	if( $_SESSION['loginok'] == "ok" && $_SESSION['level'] == '2' )
	{
?>
		<div class="banner" id="notices">
			<H2>Notices</H2>
		</div>
		<div class="notices visualIEFloatFix">
			<div class="spacer"></div>
			<div style="clear: both; height: 6px; overflow: hidden;"></div>
			<div class="body">
				<div style="text-align: left;">
					<form align="right" action="./includes/addnotice.php" method="post">
						<input type="text" name="noticeadd"  align="left" length="20"/>
						<input type="submit" style="padding: 1px 12px 1px 12px;" value="Add" />
					</form><br />
				<?php include("./includes/notices.php"); ?>
				</div>
          			</div>
		</div>

<?php
	}
	else
	{
?>

		<div class="banner" id="notices">
			<H2>Notices</H2>
		</div>
		<div class="notices visualIEFloatFix">
			<div class="spacer"></div>
			<div style="clear: both; height: 6px; overflow: hidden;"></div>
			<div class="body">
				<div style="text-align: left;">
				<?php include("./includes/notices.php"); ?>
				</div>
          			</div>
		</div>
<?php
}
?>
		<div class="container" id="box3">
                		<div class="title clickable visualIEFloatFix" id="box3_title" onmousedown="toggleDiv('box3_content',2)">
                  			<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box3_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2 class="profiles">Student Profiles</H2>
			</div>
			<div class="content" id="box3_content" >
				<p align="left">Try entering a Roll No. or a Name:</p>
				<div align="left"><input type="text" name="rollno" style="width:60%;">
				<input type="button" style="padding: 1px 12px 1px 12px;" value="Search"></div>
                        			<div align="left"><div id="SearchMessage" class="error"></div></div>
			</div>
		</div>

<?php
	if( $_SESSION['loginok'] == "ok" && $_SESSION['level'] == '1')
	{
?>

		<div class="container" id="box8">
			<div class="title clickable visualIEFloatFix" id="box8_title" onmousedown="toggleDiv('box8_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box8_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>CSL Reference</H2>
			</div>
			<div class="content" id="box8_content" >
					Important sites here.
			</div>
		</div>

<?php
	}
	elseif ( $_SESSION['loginok'] == "ok" && $_SESSION['level'] == '2' )
	{
?>

		<div class="container" id="box8">
			<div class="title clickable visualIEFloatFix" id="box8_title" onmousedown="toggleDiv('box8_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box8_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Student Evaluation</H2>
			</div>
			<div class="content" id="box8_content" >
					Content here.
			</div>
		</div>

<?php
	}
?>
	</div>

        <div class="column">
<?php
	if( $_SESSION['loginok'] == "ok")
	{
?>

		<div class="container" id="box4">
			<div class="title clickable visualIEFloatFix" id="box4_title" onmousedown="toggleDiv('box4_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box4_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Logout</H2>
			</div>
			<div class="content" id="box4_content" >
				<p>You are logged in as <b><?php echo $_SESSION['username']; ?></b>.</p>
<?php
if($_SESSION['loginok'] == "ok" && $_SESSION['level'] == '4')
{
echo "<a href='http://www.iiitcslcentral.co.cc/register.php' >Register</a>";
}
?>			

                                <form align="right" action="./includes/logout.php" method="post">
					<input type="hidden" name="logout" value="true" />
					<input type="submit" style="padding: 1px 12px 1px 12px;" value="Logout" />
				</form>
			</div>
		</div>

<?php
	}
	else
	{
?>
	
		<div class="container" id="box4">
			<div class="title clickable visualIEFloatFix" id="box4_title" onmousedown="toggleDiv('box4_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box4_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Login</H2>
			</div>
			<div class="content" id="box4_content" >
				<table style="width:100%; text-align: center;" >
				<tr>
					<td align="right" bgcolor="#E0E0E0" class="tablecontents" >Username:</td>
					<td align="left"><input type="text" name="username" id="username" size=15></td>
				</tr>
				<tr>
					<td align="right" bgcolor="#E0E0E0" class="tablecontents">Password:</td>
					<td align="left"><input type="password" name="password" size=15 id="password" ></td>
				</tr>
				<tr align="center">
					<td align="center" colspan="2"><div id="Incorrect" class="error"></div></td>
				</tr>
				<tr>
					<td ></td>
					<td align="center"><input type="button" style="padding: 1px 12px 1px 12px;" value="Login"></td>
				</tr>
				</table>
			</div>
		</div>
<?php
	}

?>


<?php
	if( $_SESSION['loginok'] == "ok" && $_SESSION['level'] == '2' )
	{
?>

		<div class="container" id="box5">
			<div class="title clickable visualIEFloatFix" id="box5_title" onmousedown="toggleDiv('box5_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box5_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Activities</H2>
			</div>
			<div class="content" id="box5_content" >
			<form align="right" action="./includes/addactivity.php" method="post">
				<input type="text" name="activityadd"  align="left" length="20"/>
				<input type="submit" style="padding: 1px 12px 1px 12px;" value="Add" />
			</form><br />
			<?php include("./includes/activities.php"); ?>
			</div>
		</div>
<?php
	}
	else
	{
?>
		<div class="container" id="box5">
			<div class="title clickable visualIEFloatFix" id="box5_title" onmousedown="toggleDiv('box5_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box5_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Activities</H2>
			</div>
			<div class="content" id="box5_content" >
 				<?php include("./includes/activities.php"); ?>
			</div>
		</div>

<?php
	}
?>

<?php
	if( $_SESSION['loginok'] == "ok" && $_SESSION['level'] == '2')
	{
?>
		<div class="container" id="box6">
			<div class="title clickable visualIEFloatFix" id="box6_title" onmousedown="toggleDiv('box6_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box6_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Results</H2>
			</div>
			<div class="content" id="box6_content" >
				Results page here.
			</div>
        		</div>

<?php
	}
	else
	{
?>
                          <div class="container" id="box6">
			<div class="title clickable visualIEFloatFix" id="box6_title" onmousedown="toggleDiv('box6_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box6_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Feedback</H2>
			</div>
			<div class="content" id="box6_content" >
				<div id="feedback_form">
						<P><B>What&#39;s on your mind?</B></P>
						<P class="center"><TEXTAREA name="feedback_text" id="feedback_text" rows="5" cols="40" style="width:80%;"></TEXTAREA></P>
    						<P>Please include your email address if you&#39;d like us to respond to a specific question.<BR></P>
						<P class="center"><INPUT type="text" name="email" style="width:80%;"></P>
                        					<p class="center"><div id="FeedbackMessage" class="error"></div></p>
						<P align="center"><input type="button" style="padding: 1px 12px 1px 12px;" value="Submit"></P>
				</div>
			</div>
        		</div>

<?php
	}
?>


<?php
if( $_SESSION['loginok'] == "ok" && $_SESSION['level'] == '1')
{
?>
		<div class="container" id="box7">
			<div class="title clickable visualIEFloatFix" id="box7_title" onmousedown="toggleDiv('box7_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box7_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Project Submission</H2>
			</div>
			<div class="content" id="box7_content" >
				File Upload protocol here.
			</div>
		</div>
         
<?php
	}
	elseif ( $_SESSION['loginok'] == "ok" && $_SESSION['level'] == '2')
	{
?>
		<div class="container" id="box7">
			<div class="title clickable visualIEFloatFix" id="box7_title" onmousedown="toggleDiv('box7_content',2)">
				<P class="togglebutton">
				<A href="javascript:;" class="toggle" id="box7_content_toggle"><IMG src="./images/arrow_down_2.gif"></A></P>
				<H2>Usage Statistics</H2>
			</div>
			<div class="content" id="box7_content" >
				Site Statistics here.
			</div>
		</div>

<?php
}
?>
	</div>
<div class="spacer"></div>
</div>

<?php include("./includes/footer.php"); ?>

</body></html>							