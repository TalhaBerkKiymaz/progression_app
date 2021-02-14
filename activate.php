<?php
 if (!(isset($_GET["content"]) && isset($_GET["id"]) && isset($_GET["pwh"]))){
  header("Location: ./index.php?content=message&alert=hacker-alert");
 }
?>


      <form action="./index.php?content=activate_script" method="post">
        <div class="form-group login-script">
          <h1>Activeren</h1>
          <label for="inputPassword">Kies een nieuw wachtwoord:</label>
          <input name="password" type="password" placeholder="Kies een wachtwoord" class="form-control" id="inputPassword" aria-describedby="passwordHelp" autofocus>
          <small id="passwordHelp" class="form-text">Kies een veilig wachtwoord..</small>

          <label for="inputPasswordCheck">Type het wachtwoord opnieuw:</label>
          <input name="passwordCheck" type="password" placeholder="Type opnieuw" class="form-control" id="inputPasswordCheck" aria-describedby="passwordHelpCheck">
          <small id="passwordHelpCheck" class="form-text">Ter controle voert u nogmaals uw wachtwoord in...</small>

          <button type="submit" class="btn btn-success btn-lg btn-block">Activeer</button>
        </div>
        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
        <input type="hidden" name="pwh" value="<?php echo $_GET["pwh"]; ?>">
        
      </form>
