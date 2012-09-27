<?php
  require_once('auth.php');

  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
     $ip=$_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
     $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
     $ip=$_SERVER['REMOTE_ADDR'];
  }

  function detect_city($ip) {
        
        $default = 'CUPERTINO, CALIFORNIA';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';

        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
        
        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();
        
        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   => $curlopt_useragent,
            CURLOPT_URL       => $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );
        
        curl_setopt_array($ch, $curl_opt);
        
        $content = curl_exec($ch);
        
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
        
        curl_close($ch);
        
        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
            $state = $regs[1];
        }

        if( $city!='' && $state!='' ){
          $location = $city . ', ' . $state;
          return $location;
        }else{
          return $default; 
        }
        
    }

    $city_state = detect_city($ip);
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
	         #userName{
	         	height: 35px;
	         }
           #password{
            height:35px;
           }
           #password2{
            height:35px;
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
              <li class="active"><a href="profile.php">Profile</a></li>
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
     	  </div><!--/.nav-collapse -->
     	  </a>
        </div>
      </div>
    </div>

    <div class="container">
      <h3>
        Welcome
      </h3> 
      <ul class="nav nav-tabs">
        <li class="active"><a href="#">Profile</a></li>
        <li><a href="venues.php">Venues</a></li>
      </ul>
      <p> Venue is still a work in progress and we are working as hard as we can to finish it up. We will notify you when Venue actually launches. Thank you for your patience and support.
      <br />
      <p> Welcome citizen of <?php echo $city_state ?> </p>
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
<html>