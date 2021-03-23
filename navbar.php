<?php
$active = (isset($_GET["content"])) ? $_GET["content"] : "";
?>
<div class="transparent" id="mainNav">
  <nav class="navbar navbar-expand-md navbar-inner">
    <a class="navbar-brand" href="./index.php?content=home">Traject Planner</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php
        if (isset($_SESSION["user_id"])) {
          switch ($_SESSION["userrole"]) {
            case 'admin':
              echo '<li class="nav-item ';
              echo (in_array($active, ["a-home", ""])) ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=a-home">a-home <span class="sr-only">(current)</span></a>
                    </li>';
              break;
            case 'director':
              echo '<li class="nav-item ';
              echo (in_array($active, ["d-home", ""])) ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=d-home">d-home <span class="sr-only">(current)</span></a>
                    </li>';
              break;
            case 'teacher':
              echo '<li class="nav-item ';
              echo (in_array($active, ["t-home", ""])) ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=class">Klassen Overzichten <span class="sr-only">(current)</span></a>
                    </li>';
              break;
            case 'student':
              echo '<li class="nav-item ';
              echo (in_array($active, ["s-home", ""])) ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=s-home">s-home <span class="sr-only">(current)</span></a>
                    </li>';
              break;
            default:
              echo '<li class="nav-item ';
              echo (in_array($active, ["home", ""])) ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=home">homehome <span class="sr-only">(current)</span></a>
                    </li>';
              break;
          }
        } else {
          echo '<li class="nav-item ';
          echo (in_array($active, ["home", ""])) ? "active" : "";
          echo '">
                  <a class="nav-link" href="./index.php?content=home">home<span class="sr-only">(current)</span></a>
                </li>';
        }
        ?>
        <!-- <li class="nav-item <?php echo ($active == "juices") ? "active" : "" ?>">
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
        </li> -->
      </ul>
      <ul class="navbar-nav ml-auto navbar-log">
        <?php
        if (isset($_SESSION["user_id"])) {
          switch ($_SESSION["userrole"]) {
            case 'admin':
              echo '<li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle ';
              echo (in_array($active, ["a-users", "a-reset_password"])) ? "active" : "";
              echo '" href="#" id="navbarDropdownMenuLinkRight" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        admin workbench
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkRight">
                        <a class="dropdown-item ';
              echo ($active == "a-users") ? "active" : "";
              echo '" href="./index.php?content=a-users">users</a>
                        <a class="dropdown-item ';
              echo ($active == "a-reset_password") ? "active" : "";
              echo '" href="./index.php?content=a-reset_password">reset password</a>
                      </div>
                    </li>';
              break;
            case 'director':
              echo '<li class="nav-item ';
              echo ($active == "d-directorpage") ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=r-rootpage">rootpage</a>
                    </li>';

              break;
            case 'teacher':
              // Maak hier de hyperlinks voor de gebruikersrol teacher
              echo '<li class="nav-item ';
              echo ($active == "assigment") ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=assigment">Opdrachten</a>
                    </li>';
              echo '<li class="nav-item ';
              echo ($active == "assigment toevoegen") ? "active" : "";
              echo '">
                      <a class="nav-link" href="./index.php?content=assigment_tvg">Opdracht Toevoegen</a>
                    </li>';


              break;
            case 'student':
              // Maak hier de hyperlinks voor de gebruikersrol student

              break;
            default:
              break;
          }
          echo '<li class="nav-item ';
          echo ($active == "logout") ? "active" : "";
          echo '">
                  <a class="nav-link" href="./index.php?content=logout">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                  <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                  </svg>
                  uitloggen</a>
                </li>';
        } else {
          echo '<li class="nav-item ';
          echo ($active == "register") ? "active" : "";
          echo '">
                  <a class="nav-link" href="./index.php?content=register">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person-fill" viewBox="0 0 16 16">
                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-1 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-3 4c2.623 0 4.146.826 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.245C3.854 11.825 5.377 11 8 11z"/>
                  </svg>
                  registreer</a>
                </li>
                <li class="nav-item ';
          echo ($active == "login") ? "active" : "";
          echo '">
                  <a class="nav-link" href="./index.php?content=login">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                  </svg>
                  inloggen</a>
                </li>';
        }
        ?>
      </ul>
    </div>
  </nav>
</div>