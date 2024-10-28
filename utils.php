<?php

# 数据库连接
$db_username = 'root';
$db_password = 'root';
$db_name = 'simple_comment';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



# 密码验证
function passwd_verify($username, $password, $conn)
{
    $sql = "SELECT * FROM User WHERE user_name = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        return ['group' => $row['user_group'], 'user_name' => $row['user_name']];
    } else {
        return false;
    }
}


# 删除数据库中的文章
function del_article($a_id, $conn)
{
    $sql = "DELETE FROM article WHERE article_id=$a_id; DELETE FROM comment WHERE article_id=$a_id;";
    if (mysqli_multi_query($conn, $sql)) {
        header("Location: article.php");
    } else {
        echo "<script>alert('删除失败');</script>";
    }
}
