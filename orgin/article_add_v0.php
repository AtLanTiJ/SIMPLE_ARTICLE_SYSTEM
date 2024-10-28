<html>

<head>
    <meta charset="utf-8">
    <title>Add_Article</title>
</head>

<body>

    <?php
    session_start();
    if (@$_SESSION['group'] == 'admin' || @$_SESSION['group'] == 'editor') {
        include('connection.php');
    } else {
        echo "<script>alert('您没有权限');</script>";
        exit(); // 终止脚本执行
    }
    ?>
    <form id="edit" name="edit" action="" method="post">
        <label for="title">标题:</label>
        <input type="text" id="title" name="title" required>
        <p>
            <label for="content">内容:</label>
        </p>
        <p>
            <textarea id="content" name="content" rows="10" cols="100" require></textarea>
        </p>
        <p><input type="submit" name="submit" value="提交"></p>
    </form>

    </body>

</html>

<?php
if (@$_SERVER['REQUEST_METHOD'] == 'POST') {

    if (@$_SESSION['group'] == 'admin' || @$_SESSION['group'] == 'editor') {
        include('connection.php'); // 确保包含数据库连接文件

        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_SESSION['user_name'];

        // 确保目录存在
        $path = 'article/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // 写入文件
        $file = fopen($path . "$title.txt", "w") or die("Unable to open file!");
        fwrite($file, $content);
        fclose($file);

        // 插入数据库
        $sql = "INSERT INTO article (title, content, author) VALUES ('$title', '$title.txt', '$author')";
        if (mysqli_query($conn, $sql)) {
            header("Location: article.php");
            exit();
        } else {
            echo "<script>alert('提交失败');</script>";
            exit();
        }
    } else {
        echo "<script>alert('提交失败');</script>";
        exit();
    }
}
?>