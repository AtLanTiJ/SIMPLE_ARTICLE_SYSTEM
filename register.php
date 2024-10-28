<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册 - Simple Article System</title>
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

        .register-container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 350px;
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

        .form-group {
            margin-top: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type='text'],
        input[type='password'] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* 添加这个属性确保padding不影响宽度 */
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
    </style>
</head>

<body>
    <div class="register-container">
        <h1>注册</h1>
        <form id='register' action='' name='register' method='post' onsubmit="return validateForm()">
            <div class="form-group">
                <label for='username'>用户名</label>
                <input type='text' name='username' id='username' placeholder='用户名' required>
            </div>
            <div class="form-group">
                <label for='password'>密码</label>
                <input type='password' name='password' id='password' placeholder='密码' required>
            </div>
            <div class="form-group">
                <label for='confirm_password'>再次确认密码</label>
                <input type='password' name='confirm_password' id='confirm_password' placeholder='确认密码' required>
            </div>
            <input type='submit' name='submit' value='注册'>
        </form>
    </div>

    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            if (password !== confirmPassword) {
                alert('两次输入的密码不一致');
                return false;
            }
            return true;
        }
    </script>

    <?php
    include('utils.php');
    error_reporting(0);

    function add_user($username, $password_hash, $conn, $group='users') {
        $sql = "INSERT INTO User (user_name, password, user_group) VALUES ('$username', '$password_hash', '$group')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function verify_username($username, $conn) {
        $sql = "SELECT * FROM User WHERE user_name = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        if ($row) {
            return false;
        } else {
            return true;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if ($username == '') {
            echo '<script>alert("用户名是必填项");window.location.href="register.php";</script>';
        } else {
            if (verify_username($username, $conn)) {
                if (add_user($username, $password_hash, $conn)) {
                    echo '<script>alert("注册成功");window.location.href="login.php";</script>';
                } else {
                    echo '<script>alert("注册失败");window.location.href="register.php";</script>';
                }
            } else {
                echo '<script>alert("用户名已存在");window.location.href="register.php";</script>';
            }
        }
    }
    ?>
</body>

</html>