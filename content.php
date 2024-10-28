<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章内容 - Simple Article System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background: #50b3a2;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            background: #fff;
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            color: #e8491d;
            margin-bottom: 0;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        .comment {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }

        .comment h6 {
            color: #50b3a2;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <?php session_start(); ?>
            <!-- <h6>您好, <?php echo (@$_SESSION['user_name'] == '' ? 'Guest' : $_SESSION['user_name']); ?></h6> -->
            <?php include('header.php'); ?>
        </header>

        <div class="content">
            <?php
            include('utils.php');
            if (isset($_SESSION['group'])) {
                $sql = "SELECT * FROM article WHERE article_id = " . $_GET['id'];
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    echo "<h1>" . ($row['title']) . "</h1>";
                    $file_path = "article/" . $row['content'];
                    $file = fopen($file_path, "r");
                    $content = fread($file, filesize($file_path));
                    echo "<hr>" . nl2br($content) . "</hr>";
            ?>
            
            <p>
            <form id="comment" name="comment" action="comment_add.php" method="POST">
                <input type="text" id="comment-input" name="comment" placeholder="写下你的评论..." required>
                <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                <input type="submit" name="submit" value="提交评论">
            </form>
            </p>

            <?php
                    $sql = "SELECT * FROM comment WHERE article_id = " . $_GET['id'];
                    $result = mysqli_query($conn, $sql);
                    while ($comment = mysqli_fetch_assoc($result)) {
                        $sql = "SELECT user_name FROM user WHERE user_id = " . $comment['user_id'];
                        $user_result = mysqli_query($conn, $sql);
                        $user_name = mysqli_fetch_row($user_result);
                        echo "<div class=\"comment\"><hr><h6> " . htmlspecialchars($user_name[0]) . ": " . ($comment['comment']) . "</h6></hr></div>";
                    }
                } else {
                    echo "<h1>文章不存在</h1>";
                }
            } else {
                echo "<h1>您没有权限查看</h1>";
            }
            ?>
        </div>
    </div>
</body>

</html>