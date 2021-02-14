<?php
$active = (isset($_GET["content"])) ? $_GET["content"] : "";
?>
<div class="navbar transparent" id="mainNav">
<nav class="navbar navbar-expand-md navbar-inner">
  <a class="navbar-brand" href="./index.php?content=home">Vegetable Juice</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php
        if (isset($_SESSION["user_id"])) {
          switch ($_SESSION["userrole"]) {
            case 'admin':
              echo '<li class="nav-item '; echo (in_array($active, ["a-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=a-home">a-home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            case 'director':
              echo '<li class="nav-item '; echo (in_array($active, ["d-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=d-home">d-home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            case 'teacher':
              echo '<li class="nav-item '; echo (in_array($active, ["t-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=t-home">t-home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            case 'student':
              echo '<li class="nav-item '; echo (in_array($active, ["s-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=s-home">s-home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            default:
              echo '<li class="nav-item '; echo (in_array($active, ["home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=home">homehome <span class="sr-only">(current)</span></a>
                    </li>';
            break;

          }
        } else {
          echo '<li class="nav-item '; echo (in_array($active, ["home", ""])) ? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=home">home<span class="sr-only">(current)</span></a>
                </li>';
        }
      ?> 
      <li class="nav-item <?php echo ($active == "juices") ? "active" : "" ?>">
        <a class="nav-link" href="./index.php?content=juices">juices</a>
      </li>
      <li class="nav-item <?php echo ($active == "smoothies") ? "active" : "" ?>">
        <a class="nav-link" href="./index.php?content=smoothies">smoothies</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php echo (in_array($active, ["sleep", "nutrition", "exercise"])) ? "active" : "" ?>" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          health education
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item <?php echo ($active == "sleep") ? "active" : "" ?>" href="./index.php?content=sleep">sleep</a>
          <a class="dropdown-item <?php echo ($active == "nutrition") ? "active" : "" ?>" href="./index.php?content=nutrition">nutrition</a>
          <a class="dropdown-item <?php echo ($active == "exercise") ? "active" : "" ?>" href="./index.php?content=exercise">exercise</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto navbar-log">
      <?php 
        if (isset($_SESSION["user_id"])) {
          switch($_SESSION["userrole"]) {
            case 'admin':
              echo '<li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle '; echo (in_array($active, ["a-users", "a-reset_password"])) ? "active" : ""; echo '" href="#" id="navbarDropdownMenuLinkRight" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        admin workbench
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkRight">
                        <a class="dropdown-item '; echo ($active == "a-users") ? "active" : ""; echo '" href="./index.php?content=a-users">users</a>
                        <a class="dropdown-item '; echo ($active == "a-reset_password") ? "active" : ""; echo '" href="./index.php?content=a-reset_password">reset password</a>
                      </div>
                    </li>';
            break;
            case 'director':
              echo '<li class="nav-item '; echo ($active == "d-directorpage") ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=r-rootpage">rootpage</a>
                    </li>';

            break;
            case 'teacher':
              // Maak hier de hyperlinks voor de gebruikersrol teacher

            break;
            case 'student':
              // Maak hier de hyperlinks voor de gebruikersrol student

            break;
            default:
            break;
          }
          echo '<li class="nav-item '; echo ($active == "logout") ? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=logout">uitloggen</a>
                </li>';
        } else {
          echo '<li class="nav-item '; echo ($active == "register")? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=register">registreer</a>
                </li>
                <li class="nav-item '; echo ($active == "login") ? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=login">inloggen</a>
                </li>';
        }
      ?>    
    </ul>
  </div>
</nav>
</div>