<?php
  function sanitize($raw_data) {
    global $conn;
    $data = htmlspecialchars($raw_data);
    $data = mysqli_real_escape_string($conn, $data);
    $data = trim($data);
    return $data;
  }

  function mk_password_hash_from_microtime() {
    $mut = microtime();

    $time = explode(" ", $mut);

    $password = $time[1] * $time[0] * 1000000;

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $onehour = mktime(1,0 ,0, 1, 1, 1970);

    $date_formated = date("d-m-Y", ($time[1] + $onehour));

    $time_formated = date("H:i:s", ($time[1] + $onehour));

    return array("password_hash" => $password_hash,
                 "date"          => $date_formated,
                 "time"          => $time_formated);
  }


  function is_authorized($userroles) {
    if(!isset($_SESSION["user_id"])){
      return header("Location: ./index.php?content=message&alert=auth-error");
    }elseif(!in_array($_SESSION["userrole"], $userroles)){
      return header("Location: ./index.php?content=message&alert=auth-error-user");
    }else{
      return true;
    }
  }

  // function determine_userrole($email)
  // {
  //   global $conn;
  //   $chop_email = explode("@", $email);

  //   if (!strcmp("mboutrecht.nl", $chop_email[1])) {
  //     // echo "docent";

  //     $sql = "SELECT  `id` FROM `teacher` WHERE `id` = '$chop_email[0]'";
  //     $result = mysqli_query($conn, $sql);
  //     // teacher
  //     if (mysqli_num_rows($result)) {
  //       $userrole = "teacher";
  //     } else {
  //       header("Location: ./index.php?content=message&alert=outside-org");
  //     }
  //   }
  //   // student
  //   else if (!strcmp("student.mboutrecht.nl", $chop_email[1])) {
  //     // echo "student";

  //     $sql = "SELECT  `student_id` FROM `student` WHERE `student_id` = '$chop_email[0]'";
  //     $result = mysqli_query($conn, $sql);
  //     if (mysqli_num_rows($result)) {
  //       $userrole = "student";
  //     } else {
  //       header("Location: ./index.php?content=message&alert=outside-org");
  //     }
  //   } else {
  //     header("Location: ./index.php?content=message&alert=outside-org");
  //   }
  // }
?>
