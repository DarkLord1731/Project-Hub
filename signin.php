<?php
include 'database.php';

$con = init_db();
session_start();

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $sql = "SELECT 
                    id as user_id,
                    user_name
                FROM
                    User
                WHERE
                    email = '" . mysqli_real_escape_string($con, $_POST['email']) . "'
                AND
                    password = '" . sha1($_POST['password']) . "'";
                     
        $result = mysqli_query($con, $sql);

        if(!$result)
        {
            echo mysqli_error();
        }
        else
        {
            if(!mysqli_num_rows($result))
            {
                echo 'You have supplied a wrong user/password combination. Please try again.';
            }
            else
            {
                $_SESSION['signed_in'] = true;
                 
                while($row = mysqli_fetch_assoc($result))
                {
                    $_SESSION['user_id']    = $row['user_id'];
                    $_SESSION['user_name']  = $row['user_name'];
                }

                // Redirect back to the original page
                $referer = $_SERVER['HTTP_REFERER'];
                header("Location: $referer");
            }
        }
    }
}
?>