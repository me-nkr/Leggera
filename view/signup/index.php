<form class="signup" action="signup/signup" method="post" accept-charset="utf-8">
  <input type="text" name="firstname" id="firstname" value="" placeholder="First name"/>
  <input type="text" name="secondname" id="secondname" value="" placeholder="Second name"/>
  <input type="text" name="username" id="username" value="" placeholder="Username"/>
  <input type="email" name="mail" id="mail" value="" placeholder="Email"/>
  <input type="password" name="password" id="password" value="" placeholder="Password"/>
  <button type="submit" name="submitSignup">Signup</button>
</form>
<div class="errorlog">
  <?php

    if (isset($_SESSION["errorlog"])) {
      
      echo $_SESSION["errorlog"] ;

      session_unset() ;
      
      session_destroy() ;
    }
  ?>
</div>