<?php include('connection.php'); ?>

<html>

<head>
    <meta charset="utf-8">
    <title>Content</title>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['group']){
        $sql = "select * from article where article_id = " . $_GET['id'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo "<h1>" . $row['title'] . "</h1>";
        echo "<hr>" . nl2br($row['content']) . "</hr>";
        $sql = "select * from comment where article_id = " . $_GET['id'];
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "select user_name from user where user_id = " . $row['user_id'];
            $result = mysqli_query($conn, $sql);
            $user_name = mysqli_fetch_row($result);
            echo "<hr><h6> " . $user_name[0] . ": " . $row['comment'] . "</h6></hr>";
        }
    }else{
        echo "<h1>您没有权限查看</h1>";
    }

    ?>


</body>

</html>