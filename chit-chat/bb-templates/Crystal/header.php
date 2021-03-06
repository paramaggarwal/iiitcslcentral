<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php bb_language_attributes( '1.1' ); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php bb_title() ?></title>
	<?php bb_feed_head(); ?> 

	<link rel="stylesheet" href="<?php bb_stylesheet_uri(); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php bb_active_theme_uri(); ?>layout.css" type="text/css" />
	
	<link href="http://cms.paramaggarwal.com/css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://cms.paramaggarwal.com/js/scripts.js"></script>
	<script type="text/javascript">

		function toggleArrow(id) {
			if ( $("#box" + id + "_content").css("height") == '1px' ) {
				$("#box" + id + "_content_toggle").html("<img src='http://cms.paramaggarwal.com/images/arrow_down_2.png'>");
			}
			else {
				$("#box" + id + "_content_toggle").html("<img src='http://cms.paramaggarwal.com/images/arrow_right_2.png'>");
			}
		}

                $(document).ready(function(){

			Nifty("div.container,div.menu","transparent");

                        $("#login_title").click(function () { $("#login_content").slideToggle("normal"); toggleArrow(1);});
                        $("#latestupdates_title").click(function () { $("#latestupdates_content").slideToggle("normal"); toggleArrow(2);});
                        $("#forums_title").click(function () { $("#forums_content").slideToggle("normal"); toggleArrow(3);});
                        $("#forum_title").click(function () { $("#forum_content").slideToggle("normal"); toggleArrow(4);});
                        $("#topic_title").click(function () { $("#topic_content").slideToggle("normal"); toggleArrow(5);});
                 });

	</script>

<?php if ( is_topic() && bb_is_user_logged_in() ) : ?>
	<script type="text/javascript">
		function addLoadEvent(func) {
			var oldonload = window.onload;
			if (typeof window.onload != 'function') {
				window.onload = func;
			} else {
				window.onload = function() {
					oldonload();
					func();
				}
			}
		}
		var lastMod = <?php topic_time( 'timestamp' ); ?>;
		var page = <?php global $page; echo $page; ?>;
		var currentUserId = <?php bb_current_user_info( 'id' ); ?>;
		var topicId = <?php topic_id(); ?>;
		var uriBase = '<?php bb_option('uri'); ?>';
		var tagLinkBase = '<?php tag_link_base(); ?>';
		var favoritesLink = '<?php favorites_link(); ?>'; 
		var isFav = <?php if ( false === $is_fav = is_user_favorite( bb_get_current_user_info( 'id' ) ) ) echo "'no'"; else echo $is_fav; ?>;

</script>
	<?php bb_enqueue_script('topic'); ?>
<?php endif; ?>

<?php bb_head(); ?>
</head>

<body id="<?php bb_location(); ?>">
	
<div id="header-content"> 
	<h1>Communication Skills Lab - IIIT, Allahabad</h1> 
</div>

	
<div id="page">	

<div id="navbar" class="menu">
	<TABLE class="navbar">
	<TBODY>
	<TR>
	
	<TD onclick="location.href='http://cms.paramaggarwal.com/'; ">Home</TD>
	<TD onclick="location.href='http://cms.paramaggarwal.com/chit-chat/'; ">Chit-Chat</TD>
	<TD onclick="location.href='http://cms.paramaggarwal.com/results.php'; ">Results</TD>
	<TD onclick="location.href='http://cms.paramaggarwal.com/contact.php'; ">Contact</TD>
	<TD onclick="location.href='http://cms.paramaggarwal.com/about.php'; ">About</TD>
	
	</TR>
	</TBODY>
	</TABLE>
</div>

<div id="content" class="clearfix">

<div class="container" id="login" >
	<div class="title clickable visualIEFloatFix" id="login_title" >
	<P class="togglebutton">
	<A href="javascript:;" class="toggle" id="login_content_toggle">
	<IMG src="http://cms.paramaggarwal.com/images/arrow_down_2.gif"></A></P>
				<?php if ( $bb_current_user->ID ) : ?>
     					<div id="profiles">
	 					<h2>Profile</h2>
	  				</div>
				 <?php else : ?>
					<div class="login" >
						<h2>Login</h2>
					</div>
				<?php endif; ?>
	</div>
	<div class="content" id="login_content" >
		<?php login_form(); ?>
	</div>     
</div>
	