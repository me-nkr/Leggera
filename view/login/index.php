<form class="login" action="login/login" method="post" accept-charset="utf-8">
  <input type="text" name="username" id="username" value="" placeholder="Username..." />
  <input type="password" name="password" id="password" value="" placeholder="Password..." />
  <button type="submit" name="submitLogin">Login</button>
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