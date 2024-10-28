<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文章列表 - Simple Article System</title>
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

        h1 {
            margin: 0;
            color: #e8491d;
        }

        article {
            background: #fff;
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .article-title a {
            color: #50b3a2;
            text-decoration: none;
        }

        .article-title a:hover {
            text-decoration: underline;
        }

        .article-meta {
            font-size: 0.8em;
            color: #666;
        }

        .article-meta a {
            color: #e8491d;
            text-decoration: none;
        }

        .article-meta a:hover {
            text-decoration: underline;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }

        .admin-actions {
            float: right;
        }

        .admin-actions a {
            color: #e8491d;
            text-decoration: none;
            margin-left: 10px;
        }

        .admin-actions a:hover {
            text-decoration: underline;
        }

        #addArticleBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #50b3a2;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        #addArticleBtn:hover {
            background-color: #e8491d;
        }

        #addArticleBtn:active {
            background-color: #e8491d;
        }

        #addArticleBtn span {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <?php session_start(); ?>
            <!-- <h6>您好, <?php echo (@$_SESSION['user_name'] == '' ? 'Guest' : $_SESSION['user_name']); ?></h6> -->
            <?php include('header.php'); ?>
            <h1>文章列表</h1>
        </header>

        <?php
        include('utils.php');
        $sql = "SELECT * FROM article";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            echo "<h2>没有文章</h2>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $file_path = "article/" . $row['content'];
                # 如果文件不存在，则删除数据库中的记录
                if (!file_exists($file_path)) {
                    del_article($row['article_id'], $conn);
                    continue;
                }

                echo "<article>";
                echo "<h3 class=\"article-title\"><a href=\"content.php?id=" . $row['article_id'] . "\">" . $row['title'] . "</a></h3>";
                $file = fopen($file_path, "r");
                $content = fread($file, filesize($file_path));
                echo "<p>" . mb_substr($content, 0, 150, 'utf-8') . "...</p>";
                $sql_c = "SELECT COUNT(*) FROM comment WHERE article_id = " . $row['article_id'];
                $cont = mysqli_fetch_row(mysqli_query($conn, $sql_c));
                echo "<div class=\"article-meta\">作者: " . $row['author'] . "    评论数: " . $cont[0];
                if (@$_SESSION['group'] == 'admin' || @$row['author'] == @$_SESSION['user_name']) {
                    echo "<div class=\"admin-actions\"><a href=\"article.php?del=" . $row['article_id'] . "\">删除</a></div>";
                }
                echo "</div>";
                echo "</article>";
                echo "<hr>";
            }
        }

        if (@$_SESSION['group'] == 'admin' && @$_SESSION['user_name'] != '' && isset($_GET['del'])) {
            // error_reporting(0);
            $a_id = $_GET['del'];
            del_article($a_id, $conn);
        }
        ?>
    </div>
    <?php
    if (@$_SESSION['group'] == 'admin' || @$_SESSION['group'] == 'editor') {
        echo "<div id=\"addArticleBtn\" onclick=\"location.href='article_add.php';\" title=\"新增文章\">";
        echo "<span>+</span>";
        echo "</div>";
    }
    ?>

</body>

</html>