<?php
  session_start();

  $f_contents = file ("slogans.txt");
  $line = $f_contents[array_rand ($f_contents)];

  if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
?>
<html>
	<head>
		<title>Venue | Places made easier</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta http-equiv="refresh" content="5">-->
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap-responsive.css">
		<style type="text/css">
	     	 body {
	         	padding-top: 60px;
	         	padding-bottom: 40px;
	         }
	         #txter{
	         	height: 30px;
	         }
           #login{
            height: 30px;
           }
           #password{
            height:30px;
           }
           #password2{
            height:30px;
           }
           #txter{
            height:30px;
           }
   		</style>
      <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34681374-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>
	<body>
	 <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">

          <?php if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) { ?>
          <a class="brand" href="index.php">Venue</a>
          <?php } else { ?>
          <a class="brand" href="profile.php">Venue</a>
          <?php } ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <?php
              if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
              {
              ?>
              <li class="active"><a href="index.php">Home</a></li>
              <?php
              } else {
              ?>
              <li class="active"><a href="profile.php">Home</a></li>
              <?php
              }
              ?>
              <li><a href="#about" data-toggle="modal">About</a></li>
              <li><a href="contact.php">Contact</a></li>
              <?php
              if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
              {
              ?>
              <?php }

                else {  
              ?>
              <li><a href="venues.php">Venues</a></li>
              <?php } ?>
             <!-- <li class="dropdown">
                    <a href="#"
                    class="dropdown-toggle"
                    data-toggle="dropdown">
                    Documentation
                    <b class="caret"></b>
              		</a>

              
            <ul class="dropdown-menu" style="">
              <li><a href="">Venue Log</a></li>
                <li><a href="">Forum</a></li>
                <li class="divider"></li>
                <li class="nav-header">Legal</li>
                <li><a href=""> Terms of Service</a></li>
                <li><a href=""> Privacy</a></li>
              </ul>
             </li>-->
            </ul>
            <?php
            if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
            {
            ?>
            <form class="navbar-form pull-right" action="login-exec.php" id="loginForm" name="loginForm" method="post" >
              <input class="span2" name="login" type="text" id="login" placeholder="Email">
              <input class="span2" name="password" type="password" id="password" placeholder="Password">
              <button name="Submit" type="submit" id="Submit" class="btn">Sign in</button>
            </form>
            <?php } 

            else {?>
            <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?php echo $_SESSION['login']; ?>              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="profile.php">Profile</a></li>
              <li class="divider"></li>
              <li><a href="logout.php">Sign Out</a></li>
            </ul>
          </div>
          <?php } ?>
     	  </div><!--/.nav-collapse -->
     	  </a>
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <h1><?php echo $line ?></h1>
        <p>Venue allows you to find, share, like, review, and rent places available around you, just sign up. You can also simply host your own places and make some money while also reaching out to new customers.</p>
        <?php
          if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
          {
        ?>
        <p><a href="register.php" class="btn btn-primary btn-large">Sign Up &raquo;</a></p>
        <?php 
          }
        ?>

      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Rent</h2>
          <p>Want to throw a party or hold a get together with friends or family? Browse through the places available near your area. Easily rent a place for your occasion through Venue.</p>
          <?php
          if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
          {
          ?>
          <p><a class="btn" href="register.php">Start Renting &raquo;</a></p>
          <?php } ?>
        </div>
        <div class="span4">
          <h2>Host</h2>
          <p>Have an amazing hotel ballroom or luxurious party center with a swimming pool? You can easily put it up and share it with friends on Venue. You decide the price.</p>
          <?php
          if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
          {
          ?>
          <p><a class="btn" href="register.php">Start Hosting &raquo;</a></p>
          <?php } ?>
       </div>
        <div class="span4">
          <h2>Share</h2>
          <p>Been to an amazing convention center or a remarkable outdoor garden? Share it with your friends on Venue and your friends might just invite you there for a party.</p>
          <?php
          if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
          {
          ?>
          <p><a class="btn" href="register.php">Sign Up &raquo;</a></p>
          <?php } ?>
        </div>
      </div>

      <hr>

      <footer>
        <p>
        	&copy; Venue 2012 &middot; <a href="">About</a> &middot; <a href="">Terms</a> &middot; <a href="">Privacy</a>
        <span class="pull-right">
          By Zuhayeer Musa
        </span>
        </p>
      </footer>

    </div>

    <div id="about"
       class="modal hide fade in">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Venue</h3>
  </div>
  <div class="modal-body">
    <p>Venue allows you to rent, host, and share places near your area for special occasions such as family reunions, birthday parties, weddings, and even more.</p>
  </div>
  <div class="modal-footer">
    <a data-dismiss="modal" class="btn">Close</a>
     <?php
      if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
      {
     ?>
    <a href="register.php" class="btn btn-primary">Sign Up</a>
    <?php } ?>
  </div>
</div>

    <!--<div class="modal-header">
      <a class="close"
           data-dismiss="modal">x</a>

      <h3>About</h3>

      <table>
        <tr>
          <td width="450">
          	<div class="well">
          		<p>Venue allows you to rent, host, and share places near your area for special occasions such as family reunions, birthday parties, weddings, and even more.</p>
          	</div>
          </td>
          <td width="450">
          	<p>Sign Up</p>
          </td>
        </tr>
      </table>-->
    </div>
  <div id="about" class="modal hide fade in"> 
  <div class="modal-header"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><br>
    </a></div>
  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
  <!-- end about page -->
  <!-- Javascript Animation -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
  <script src="css/bootstrap/js/jquery.js" type="text/javascript"></script>
  <script src="css/bootstrap/js/bootstrap.js" type="text/javascript"></script>
  </a></div>

</body>
</html>
<?php
  }
  else {
    header('Location: profile.php');
  }
?>