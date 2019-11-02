<?php
include 'database.php';

$con = init_db();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    session_start();
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
    {
      $sql = "INSERT INTO Project(category, title, video, thumbnail, content, author) 
              VALUES ('" . mysqli_real_escape_string($con, $_POST['category']) . "', 
                      '" . mysqli_real_escape_string($con, $_POST['title']) . "', 
                      '" . mysqli_real_escape_string($con, $_POST['youtube_video_id']) . "', 
                      '" . mysqli_real_escape_string($con, $_POST['logo_url']) . "', 
                      '" . mysqli_real_escape_string($con, $_POST['description']) . "', 
                      '" . $_SESSION['user_id'] . "');";

      $result = mysqli_query($con, $sql);
      if(!$result)
      {
          echo 'Something went wrong while registering. Please try again later.';
          echo mysqli_error($con);
      }
      else
      {
          // Redirect to the project page
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
