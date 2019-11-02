<?php
include 'database.php';

$con = init_db();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    session_start();
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
    {
      $sql = "INSERT INTO Comment(user, project, content) 
              VALUES ('" . mysqli_real_escape_string($con, $_SESSION['user_id']) . "', 
                      '" . mysqli_real_escape_string($con, $_POST['project_id']) . "', 
                      '" . mysqli_real_escape_string($con, $_POST['message']) . "'
                    )";

      $result = mysqli_query($con, $sql);

      if(!$result)
      {
          echo 'Something went wrong while registering. Please try again later.';
          echo mysqli_error($con);
      }
      else
      {
          $referer = $_SERVER['HTTP_REFERER'];
          header("Location: $referer");
      }
    }
    else
    {
      echo 'You need to sign in first';
    }
}

mysqli_close($con);
?>