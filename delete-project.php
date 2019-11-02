<?php
include 'database.php';

$con = init_db();

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    session_start();
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
    {
      $sql = "DELETE FROM 
                  Project
              WHERE 
                  id = '" . mysqli_real_escape_string($con, $_GET['project_id']) . "';";

      $result = mysqli_query($con, $sql);

      if(!$result)
      {
          echo 'Something went wrong while registering. Please try again later.';
          echo mysqli_error($con);
      }
      else
      {
          // Redirect to the project page
          header("Location: /");
      }
    }
    else
    {
      echo 'You need to sign in first';
    }
}

mysqli_close($con);
?>
