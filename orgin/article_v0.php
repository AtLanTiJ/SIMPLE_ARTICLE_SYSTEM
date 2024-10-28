<?php include('connection.php'); ?>

<html>

<head>
    <meta charset="utf-8">
    <title>Article</title>
</head>

<body>
    <?php
    session_start();
    $user_name = (@$_SESSION['user_name']==''?'Guest':$_SESSION['user_name']);
    echo "<h6>you are:" . $user_name . "</h6>";
    echo "<h1>Article List</Article></h1>";
    $sql = "select * from article";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo "<h2>没有文章</h2>";
    }
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<hr><h3><a href=content.php?id=" . $row['article_id'] . ">" . $row['title'] . "</a></h3>";
        echo "<p><h6>" . mb_substr($row['content'], 0, 150, 'utf-8') . "...</h6></p>";
        $sql_c = "select count(*) from comment where article_id = " . $row['article_id'];
        $cont = mysqli_fetch_row(mysqli_query($conn, $sql_c));
        echo "<p><h6>Author: " . $row['author']  . str_repeat('&nbsp;', 10) . "    评论数:" . $cont[0] . str_repeat('&nbsp;', 10);
        if (@$_SESSION['group'] == 'admin') {
            echo "<a href=article.php?del=" . $row['article_id'] . ">删除</a></h6></p></hr>";
        }
    }


    if (@$_SESSION['group'] == 'admin' && $user_name && isset($_GET['del'])) {
        error_reporting(0);
        $del = $_GET['del'];
        $sql = "delete from article where article_id=$del; delete from comment where article_id=$del;";
        if (mysqli_multi_query($conn, $sql)) {
            header("Location:article.php");
        } else {
            echo "<script>alert('删除失败')</script>";
        }
    }
    ?>
</body>

</html>