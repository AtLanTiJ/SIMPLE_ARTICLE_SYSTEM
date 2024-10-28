<?php
    session_start();
    if (@$_SERVER['REQUEST_METHOD'] == 'POST' && @$_SESSION['user_name']) {
        include('utils.php');
        error_reporting(0);

        $username = $_SESSION['user_name'];
        $comment = $_POST['comment'];
        $article_id = $_POST['article_id'];

        $sql_uid = "select user_id from user where user_name = '$username'";
        $result_uid = mysqli_query($conn, $sql_uid);
        $uid = mysqli_fetch_assoc($result_uid)['user_id'];

        $sql_insert = "insert into comment(user_id, article_id, comment) values ($uid, $article_id, '$comment')";
        if (mysqli_query($conn, $sql_insert)){
            header("Location: content.php?id=$article_id");
        } else {
            echo "<script>alert('评论失败');</script>";
        }

    }
