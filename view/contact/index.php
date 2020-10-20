<form action="contact/test" method="post" accept-charset="utf-8" class="contact">
  <input type="text" name="name" id="name" value=""placeholder="Name" />
  <textarea name="msg" id=msg rows="8" cols="23"placeholder="msg" ></textarea>
  <button type="submit">Submit</button>
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