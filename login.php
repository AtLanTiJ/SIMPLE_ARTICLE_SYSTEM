<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录 - Simple Article System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            font-size: 2em;
            color: #50b3a2;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type='text'],
        input[type='password'] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type='submit'] {
            margin-top: 20px;
            padding: 10px;
            background: #50b3a2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type='submit']:hover {
            background: #449d84;
        }

        p {
            margin-top: 20px;
            text-align: center;
        }

        a {
            color: #50b3a2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>登录</h1>
        <form id='login' action='' name='login' method='POST'>
            <label for='username'>用户名</label>
            <input type='text' name='username' id='username' placeholder='用户名' required>
            <label for='password'>密码</label>
            <input type='password' name='password' id='password' placeholder='密码' required>
            <input type='submit' name='submit' value='登录'>
        </form>
        <p>
            还没有账号？<a href="register.php">点击注册</a>
        </p>
    </div>

    <?php

    include('utils.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username == '') {
            echo '<script>alert("用户名是必填项");window.location.href="login.php";</script>';
        } else {
            $result = passwd_verify($username, $password, $conn);
            if ($result) {
                session_start();
                $_SESSION['user_name'] = $result['user_name'];
                $_SESSION['group'] = $result['group'];

                header("Location: article.php");
                exit();
            } else {
                echo '<script>alert("用户名或密码不正确");window.location.href="login.php";</script>';
            }
        }
    }
    ?>
</body>

</html>