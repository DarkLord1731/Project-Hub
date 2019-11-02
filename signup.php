<?php
include 'database.php';

$con = init_db();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO 
                User (user_name, password, email)
            VALUES
                ('" . mysqli_real_escape_string($con, $_POST['username']) . "',
                   '" . sha1($_POST['password']) . "',
                   '" . mysqli_real_escape_string($con, $_POST['email']) . "'
                )";
                     
    $result = mysqli_query($con, $sql);

    if(!$result) {
        echo mysqli_error($con);
    }
    else {
        $sql = "SELECT 
                    id,
                    user_name
                FROM
                    User
                WHERE
                    email = '" . mysqli_real_escape_string($con, $_POST['email']) . "'
                AND
                    password = '" . sha1($_POST['password']) . "'";
                     
        $result = mysqli_query($con, $sql);

        if($result) {
            session_start();
            $_SESSION['signed_in'] = true;
             
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['user_id']    = $row['id'];
                $_SESSION['user_name']  = $row['user_name'];
            }
        }
        // Redirect back to the previous page
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
    }
}

mysqli_close($con);
?>
