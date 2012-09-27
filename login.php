<?php
  session_start();
  if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
  {
    
  }
  else
  {
    header("Location: index.php");
  }
?>
<html>
	<head>
		<title>Venue | Places made easier</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

          <a class="brand" href="index.php">Venue</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class=""><a href="index.php">Home</a></li>
              <li><a href="#about" data-toggle="modal">About</a></li>
              <li><a href="contact.php">Contact</a></li>
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
    <form class="form-horizontal" action="login-exec.php" id="loginForm" name="loginForm" method="post" >
      <legend>Sign In</legend>
        <?php
        /* Display error messages */
        if(isset($_SESSION['ERRMSG_ARR'])){
          foreach($_SESSION['ERRMSG_ARR'] as $msg) {?>
          <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oops!</strong> <?=$msg;?>
          </div>
        <?php }} $_SESSION['ERRMSG_ARR'] = NULL;?>
      <div class="control-group">
        <label class="control-label" for="inputEmail">Email</label>
        <div class="controls">
          <input name="login" type="text" id="login" placeholder="Email">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputPassword">Password</label>
        <div class="controls">
          <input name="password" type="password" id="password" placeholder="Password">
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button name="Submit" type="submit" id="Submit" class="btn">Sign in</button>
          <br /> <br />
          <label>Don't have an account? Sign up <a href="register.php">here</a></label>
        </div>
      </div>
    </form>

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
  <!--    <div class="pull-left">
      <div class="cell">
        <div class="share-wrapper below">
          <div class="rc10 share-action icon-share"></div>
          <div class="share-container rc10 ">
            <a class="share-btn tl icon-google-plus" href='#'></a>    
            <a class="share-btn tr icon-twitter" href='#'></a>    
            <a class="share-btn br icon-facebook" href='#'></a>    
            <a class="share-btn bl icon-pinterest" href='#'></a>    
          </div>
        </div>
      </div>
    </div>-->
</body>
</html>