<?php
if (empty($_POST["email"])) {
  header("Location: ./index.php?content=message&alert=no-email");
} else {
  include("./connect_db.php");
  include("./functions.php");

  $email = sanitize($_POST["email"]);

  $sql = "SELECT * FROM `register` WHERE `email` = '$email'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)) {
    header("Location: ./index.php?content=message&alert=emailexists");
  } else {

    // voor en -na het @ bepalen student of teacher is.
    $chop_email = explode("@", $email);

    if (!strcmp("mboutrecht.nl", $chop_email[1])) {
      // echo "docent";

      $sql = "SELECT  `id` FROM `teachers` WHERE `id` = '$chop_email[0]'";
      $result = mysqli_query($conn, $sql);
      // teacher
      if (mysqli_num_rows($result)) {
        $userrole = "teacher";
      } else {
        header("Location: ./index.php?content=message&alert=outside-org");
      }
    }
    else if (!strcmp("student.mboutrecht.nl", $chop_email[1])) {
      // echo "student";

      $sql = "SELECT  `student_id` FROM `students` WHERE `student_id` = '$chop_email[0]'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result)) {
        $userrole = "student";
      } else {
        header("Location: ./index.php?content=message&alert=outside-org");
      }
    } else {
      header("Location: ./index.php?content=message&alert=outside-org");
    }


    // De functie mk_password_hash_from_microtime() maakt een password hash,
    // haalt de tijd en datum op op basis van de php-functie microtime() 
    // en geeft dit terug in $array
    $array = mk_password_hash_from_microtime();

    $sql = "INSERT INTO `register` (`user_id`,
                                      `email`,
                                      `password`,
                                      `userrole`,
                                      `activated`)
              VALUES                 (NULL,
                                      '$email',
                                      '{$array["password_hash"]}',
                                      '{$userrole}',
                                      0)";
    // echo $sql;exit();
    if (mysqli_query($conn, $sql)) {

      $id = mysqli_insert_id($conn);

      $mbo_id = explode("@", $email)[0];
      // echo $mbo_id; exit();
      $tbl_name = $userrole . "s";

      $sql="UPDATE `{$tbl_name}`
            SET `register_id` = $id
            WHERE `id` = '{$mbo_id}'";
            // echo $sql; exit();

      if(!mysqli_query($conn, $sql))
      {
        header("Location: ./index.php?content=message&alert=register-error");

      } 

      
      $to = $email;
      $subject = "Activatielink voor uw schoolaccount";
      // include("./email.php");
      include("./alt-email.php");

      $headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: text/html; charset=UTF-8\r\n";
      $headers .= "From: admin@progression.org\r\n";
      $headers .= "Cc: moderator@progression.org\r\n";
      $headers .= "Bcc: root@progression.org";

      mail($to, $subject, $message, $headers);

      header("Location: ./index.php?content=message&alert=register-success");
    } else {
      header("Location: ./index.php?content=message&alert=register-error");
    }
  }
}
