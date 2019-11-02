<?php

function init_db(){
    $server = 'localhost';
    $username   = 'root';
    $password   = 'password';
    $database   = 'ProjectHub';

    $con=mysqli_connect($server, $username,  $password);
    mysqli_select_db($con, $database);

    return $con;
}

function get_project_count($cat_id){
    $con = init_db();

    $sql = "SELECT id 
            FROM Project 
			WHERE category = '$cat_id'";
     
    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'ERROR: ' . mysqli_error($con);
    }
    else
    {
	    return mysqli_num_rows($result);
    }
}

function get_comment_count($proj_id){
    $con = init_db();

    $sql = "SELECT id 
            FROM Comment 
            WHERE project = '$proj_id' 
            ORDER BY created_at";

    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'ERROR: ' . mysqli_error($con);
    }
    else
    {
        return mysqli_num_rows($result);
    }
}

function get_projects($para=array()){
    $con = init_db();
    $single = false;

    $sql = "SELECT Project.id as project_id,
                    Project.created_at as created_at,
                    Project.title as title,
                    Project.video as video,
                    Project.thumbnail thumbnail,
                    Project.content as content,
                    Project.rating as rating,
                    Project.price as price,
                    User.id as user_id,
                    User.user_name as user_name,
                    User.bio as bio
            FROM Project 
            INNER JOIN Category ON Project.category = Category.id 
            INNER JOIN User ON Project.author = User.id";

    if (isset($para['category_id']) && !is_null($para['category_id']))
    {
        $sql .= " WHERE Project.category = " . mysqli_real_escape_string($con, $para['category_id']);
    }
    else if (isset($para['project_id']) && !is_null($para['project_id']))
    {
        $sql .= " WHERE Project.id = " . mysqli_real_escape_string($con, $para['project_id']);
        $single = true;
    }

    $sql .= " ORDER BY created_at DESC ";

    if (isset($para['limit']) && !is_null($para['limit'])){
        $sql .= "LIMIT ".$para['limit'];
    }

    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'The topics could not be displayed, please try again later.' . mysqli_error($con);
    }
    else
    {
        $projects = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $row['created_at'] = date('d-m-Y', strtotime($row['created_at']));
            $row['video_url'] = "https://www.youtube.com/watch?v=" . $row['video'];
            $row['video_thumbnail'] = "https://img.youtube.com/vi/" . $row['video'] . "/hqdefault.jpg";
            $projects[] = $row;

            if($single)
            	return $row;
        }

        return $projects;
    }
}

function get_recent_projects($cat_id=null){
    $con = init_db();

    $sql = "SELECT Project.id as project_id,
                    Project.created_at as created_at,
                    Project.title as title,
                    Project.video as video,
                    Project.thumbnail thumbnail,
                    Project.title as title,
                    Project.content as content,
                    Project.rating as rating,
                    User.id as user_id,
                    User.user_name as user_name,
                    User.bio as bio
            FROM Project 
            INNER JOIN Category ON Project.category = Category.id 
            INNER JOIN User ON Project.author = User.id
            ORDER BY Project.created_at DESC
            LIMIT 5";

    if (!is_null($cat_id))
        $sql .= " WHERE category = '$cat_id'";
     
    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'The topics could not be displayed, please try again later.' . mysqli_error($con);
    }
    else
    {
        $projects = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $row['created_at'] = date('d-m-Y', strtotime($row['created_at']));
            $row['video_url'] = "https://www.youtube.com/watch?v=" . $row['video'];
            $row['video_thumbnail'] = "https://img.youtube.com/vi/" . $row['video'] . "/hqdefault.jpg";
            $projects[] = $row;
        }

        return $projects;
    }
}

function get_category_list($cat_id=null){
    $con = init_db();
    $sql = "SELECT * FROM Category";

    if (!is_null($cat_id))
        $sql .= " WHERE id = '$cat_id'";

    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'The topics could not be displayed, please try again later.' . mysqli_error($con);
    }
    else
    {
        if(mysqli_num_rows($result) == 0)
        {
            echo 'There are no topics in this category yet.';
        }
        else
        {
            $categories = array();

            while($row = mysqli_fetch_assoc($result))
            {
                $categories[] = $row;
            }

            return $categories;
        }
    }
}

function get_comments($proj_id){
    $con = init_db();
    $sql = "SELECT Comment.content as content,
    			   Comment.created_at as created_at,
    			   User.user_name as username
    		FROM Comment
    		INNER JOIN Project ON Comment.project = Project.id
    		LEFT JOIN User ON Comment.user = User.id
    		WHERE Project.id = $proj_id";

    $result = mysqli_query($con, $sql);

    if(!$result)
    {
        echo 'The topics could not be displayed, please try again later.' . mysqli_error($con);
    }
    else
    {
        $categories = array();

        while($row = mysqli_fetch_assoc($result))
        {
        	$row['created_at'] = date('M d, Y', strtotime($row['created_at']));
            $categories[] = $row;
        }

        return $categories;
    }
}

function get_val($index)
{
	if (isset($_SESSION[$index]))
		return $_SESSION[$index];
	else
		return "";
}

if (isset($_GET['like']))
{
	$con = init_db();

	$sql = "SELECT rating
			FROM Project
			WHERE id = " . $_GET['like'];
	
	$result = mysqli_query($con, $sql);
	$orig_likes = mysqli_fetch_assoc($result)['rating'];
	$orig_likes++;

	$sql = "UPDATE Project 
			SET rating = " . $orig_likes . "
			WHERE id = " . $_GET['like'];

	$result = mysqli_query($con, $sql);

    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
}
?>