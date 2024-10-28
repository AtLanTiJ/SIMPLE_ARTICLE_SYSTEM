<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Article System</title>
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
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        header a:hover {
            background-color: #449d84;
        }

        .content {
            background: #fff;
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* 顶部导航样式 */
        .top-nav {
            display: flex;
            align-items: center;
        }

        .top-nav h6 {
            margin: 0;
            padding: 0;
        }

        /* 首页按钮样式 */
        .home-button {
            cursor: pointer;
            background-color: #5090b3;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 14px;
        }

        .home-button:hover {
            background-color: #cc5252;
        }

        /* 用户信息样式 */
        .user-info {
            margin-left: auto;
            padding-left: 20px;
            /* 添加空间 */
        }

        .user-info h6 {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="top-nav">
                <a href="index.html">
                    <button class="home-button">首页</button>
                </a>
                <div class="user-info">
                    <h6>您好, <?php echo (@$_SESSION['user_name'] == '' ? 'Guest' : $_SESSION['user_name']); ?></h6>
                </div>
            </div>
        </header>