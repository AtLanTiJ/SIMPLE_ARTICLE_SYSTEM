<?php include('connection.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>
    <h1>登录</h1>
    <form id='login' action='' name='login' method='POST'>
        <label for='username'>Username</label>
        <input type='text' name='username' id='username' placeholder='Username' required>
        <label for='password'>Password</label>
        <input type='password' name='password' id='password' placeholder='Password' required>
        <input type='submit' name='submit' value='Login'>
    </form>
    <p>
    <h6>还没有账号？<a href="register.php">点击注册</a></h6>
    </p>
</body>

</html>


<?php
// error_reporting(0);

function passwd_verify($username, $password, $conn)
{
    $sql = "select * from User where user_name = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        return ['group' => $row['user_group'], 'user_name' => $row['user_name']];
    } else {
        return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == '') {
        echo '<script>alter(Username is required);window.location.href="login.php";</script>';
    } else {
        $result = passwd_verify($username, $password, $conn);
        if ($result) {
            session_start();
            if ($result['group'] == 'admin') {
                $_SESSION['group'] = $result['group'];
            } else {
                $_SESSION['group'] = 'article';
            }
            $_SESSION['user_name'] = $result['user_name'];

            header("Location:article.php" );
            exit();
        } else {
            echo '<script>alert("Username or password is incorrect");window.location.href="login.php";</script>';
        }
    }
}
