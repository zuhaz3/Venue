<?php
  session_start();

    $errflag = false;
    $traincontact = false;      
    $msg = NULL;

  if ($_POST['submit'] == 1)
  {
       $errflag = false;
       $traincontact = false;
       $msg = NULL;

       // from the form
       $name = trim(strip_tags($_POST['name']));
       $subject = trim(strip_tags($_POST['subject']));
       $email = trim(strip_tags($_POST['email']));
       $body = htmlentities($_POST['body']);

       if ($name == NULL)
       {
          $errflag = true;
          $msg = 'Please enter your name.';
       }

       if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email) == false && $errflag == false)
       {
          $errflag = true;
          $msg = 'Please enter a valid email.';
       }

       if ($subject == NULL && $errflag == false)
       {
          $errflag = true;
          $msg = 'Please enter a subject.';
       }

       if ($body == NULL && $errflag == false)
       {
          $errflag = true;
          $msg = 'Please have content in your body.';
       }


       if ($errflag == false)
       {
         // set here
         $to = 'youremail@domain.com';

         $body = <<<HTML
$body
HTML;

         $headers = "From: $email\r\n";
         $headers .= "Content-type: text/html\r\n";

         // send the email
         if (mail($to, $subject, $body." ".$name." "."via Venue Contact Form", $headers))
         {
            $traincontact = true;
         }
         else
         {
            $errflag = true;
            $msg = 'Your message was not sent. Please try again.';
         }
       }
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
           #focusedInput{
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
              <li class=""><a href="index.php">Home</a></li>
              <?php
              } else {
              ?>
              <li class=""><a href="profile.php">Profile</a></li>
              <?php
              }
              ?>
              <li><a href="#about" data-toggle="modal">About</a></li>
              <li class="active"><a href="contact.php">Contact</a></li>
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
              <li><a href="profile.php"><i class="icon-home">         </i>   Profile</a></li>
              <li class="divider"></li>
              <li><a href="logout.php"><i class="icon-remove-sign">         </i>   Sign Out</a></li>
            </ul>
          </div>
          <?php } ?>
        </div><!--/.nav-collapse -->
        </a>
        </div>
      </div>
    </div>

    <div class="container">

      <form class="form-horizontal" action="<? echo $_SERVER['PHP_SELF'];?>" method="post" >
        <legend>Contact Us</legend>
        <?php
        /* Display error messages */
        if($errflag == true)
        {?>
          <div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Oops!</strong> <?=$msg;?>
          </div>
        <?php } 

        if ($traincontact == true) {
        ?>
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Success!</strong> Your message has been sent. We will get back to you soon.
          </div>
        <?php } ?>
        <div class="control-group">
          <label class="control-label" for="inputName">Name</label>
          <div class="controls">
            <input name="name" type="text" id="login" placeholder="eg. Zuhayeer Musa">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputEmail">Email</label>
          <div class="controls">
            <?php 
            if (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == ''))
            {
            ?>
            <input name="email" type="text" id="login" placeholder="example@example.com">
            <?php } else { ?>
            <input name="email" type="text" id="focusedInput" value=<?php echo $_SESSION['login']; ?>>
            <?php } ?>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputSubject">Subject</label>
          <div class="controls">
            <input name="subject" type="text" id="login" placeholder="Subject">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputBody">Body</label>
          <div class="controls">
            <textarea name="body" rows="5" type="text" placeholder="I want to..."></textarea>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button name="submit" type="submit" class="btn" value="1">Submit</button>
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

</body>
</html>