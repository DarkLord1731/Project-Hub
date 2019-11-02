<?php
include 'database.php';

$con = init_db();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    session_start();
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
    {
      $sql = "UPDATE 
                  Project
              SET 
                  category = '" . mysqli_real_escape_string($con, $_POST['category']) . "', 
                  title = '" . mysqli_real_escape_string($con, $_POST['title']). "', 
                  video = '" . mysqli_real_escape_string($con, $_POST['youtube_video_id']) . "', 
                  thumbnail = '" . mysqli_real_escape_string($con, $_POST['logo_url']) . "', 
                  content = '" . mysqli_real_escape_string($con, $_POST['description']) . "'
              WHERE 
                  id = '" . mysqli_real_escape_string($con, $_POST['project_id']) . "';";

      $result = mysqli_query($con, $sql);

      if(!$result)
      {
          echo 'Something went wrong while registering. Please try again later.';
          echo mysqli_error($con);
      }
      else
      {
          // Redirect to the project page
          $referer = "/project/".$_POST['project_id']."/".preg_replace('/\s+/', '-', $_POST['title']);
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
