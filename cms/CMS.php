<?php

class simpleCMS {

  var $host;
  var $username;
  var $password;
  var $table;

  public function display_public() {
    $q = "SELECT * FROM testDB ORDER BY created DESC LIMIT 15";
    $r = mysql_query($q);

    if ( $r !== false && mysql_num_rows($r) > 0 ) {
      <<<ENTRY_DISPLAY
      <legend>Venues Available</legend>
ENTRY_DISPLAY;
      while ( $a = mysql_fetch_assoc($r) ) {
        $name = stripslashes($a['name']);
        $location = stripslashes($a['location']);
        $contact = stripslashes($a['contact']);
        $price = stripslashes($a['price']);
        $avail = stripslashes($a['avail']);
        $link = stripslashes($a['link']);
        $info = stripslashes($a['info']);

        $entry_display .= <<<ENTRY_DISPLAY

      
      <h5 style="margin-right: 500px;"> $name <br /></h5>
      <p style="margin-right: 500px;">
        $location
        <br />
        $contact
      </p>
      <p style="margin-right: 500px;">$$price.00</p>
      <p style="margin-right: 500px;">$info</p>
      <p style="margin-right: 500px;">More information at <a href="$link" target="_blank">$link</a></p>
      <p style="margin-right: 500px;">Available: $avail</p>
      <br />
        <form action="http://maps.google.com/maps" method="get" target="_blank">
           <label for="saddr">Enter your location to get directions</label>
           <input type="text" id="txter" name="saddr" class="brood" placeholder="Location...">
           <input type="hidden" name="daddr" value="$location">
           <button type="submit" class="btn">Get Directions</button>
        </form>
        <hr>

ENTRY_DISPLAY;
      }
    } else {
      $entry_display = <<<ENTRY_DISPLAY

    <legend>No Venues Available</legend>
    <p>
      Nobody has a venue around your area. Sorry, be sure to check back soon or submit your own!
    </p>

ENTRY_DISPLAY;
    }
    $entry_display .= <<<ADMIN_OPTION

    <p class="admin_link">
      <a href="{$_SERVER['PHP_SELF']}?admin=1">Add Venue</a>
    </p>

ADMIN_OPTION;

    return $entry_display;
  }

  public function display_admin() {
    return <<<ADMIN_FORM

    <form class="form-horizontal" action="{$_SERVER['PHP_SELF']}" method="post" >
        <legend>Add a Venue</legend>

      <div class="control-group">
        <label class="control-label" for="name">Name</label>
        <div class="controls">
          <input name="name" type="text" id="txter" placeholder="eg. Hilton Hotel">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="location">Address</label>
        <div class="controls">
          <input name="location" type="text" id="txter" placeholder="1234 Someplace Ave">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="contact">Contact</label>
        <div class="controls">
          <input name="contact" type="text" id="txter" placeholder="Email or Phone">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="price">Price</label>
        <div class="controls">
          <div class="input-prepend input-append">
            <span class="add-on">$</span><input name="price" class="span2" type="text" id="txter" placeholder="eg. 500"><span class="add-on">.00</span>
          </div>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="avail">Availability</label>
        <div class="controls">
          <input name="avail" type="text" id="txter" placeholder="Seasonal? Time of Year">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="link">Link</label>
        <div class="controls">
          <input name="link" type="text" id="txter" placeholder="For more info...">
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="info">Information</label>
        <div class="controls">
          <textarea name="info" rows="5" placeholder="What's special about it..."></textarea>
        </div>
      </div>
      
      <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Add Venue</button>
          </div>
      </div>
    </form>
    
    <br />
    
    <a href="venues.php">Back to Venues</a>

ADMIN_FORM;
  }

  public function write($p) {
    if ( $_POST['name'] )
      $name = mysql_real_escape_string($_POST['name']);
    if ( $_POST['location'])
      $location = mysql_real_escape_string($_POST['location']);
    if ( $_POST['contact'])
      $contact = mysql_real_escape_string($_POST['contact']);
    if ( $_POST['price'])
      $price = mysql_real_escape_string($_POST['price']);
    if ( $_POST['avail'])
      $avail = mysql_real_escape_string($_POST['avail']);
    if ( $_POST['link'])
      $link = mysql_real_escape_string($_POST['link']);
    if ( $_POST['info'])
      $info = mysql_real_escape_string($_POST['info']);
    if ( $name && $info ) {
      $created = time();
      $sql = "INSERT INTO testDB VALUES('$name','$location','$contact', '$price', '$avail', '$link', '$info', '$created')";
      return mysql_query($sql);
    } else {
      return false;
    }
  }

  public function connect() {
    mysql_connect($this->host,$this->username,$this->password) or die("Could not connect. " . mysql_error());
    mysql_select_db($this->table) or die("Could not select database. " . mysql_error());

    return $this->buildDB();
  }

  private function buildDB() {
    $sql = <<<MySQL_QUERY
CREATE TABLE IF NOT EXISTS testDB (
name		VARCHAR(150),
location	TEXT,
contact  TEXT,
price  TEXT,
avail  TEXT,
link TEXT,
info  TEXT,
created		VARCHAR(100)
)
MySQL_QUERY;

    return mysql_query($sql);
  }

}

?>