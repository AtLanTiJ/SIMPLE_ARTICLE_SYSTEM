<?php include('connection.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>sign up</title>
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
</head>


<body>
    <h1>注册</h1>
    <form id='register' action='' name='register' method='post' onsubmit="return validateForm()">
        <label for='username'>用户名</label>
        <input type='text' name='username' id='username' placeholder='Username' required>
        <p>
            <label for='password'>密码</label>
            <input type='password' name='password' id='password' placeholder='Password' required>
        </p>
        <p>
            <label for='confirm_password'>再次确认密码 </label>
            <input type='password' name='confirm_password' id='confirm_password' placeholder='Confirm Password' required>
        </p>
        <input type='submit' name='submit' value='注册'>
    </form>
</body>

</html>



<?php
error_reporting(0);


function add_user($username, $password_hash, $conn, $group='users'){
    $sql = "insert into user (user_name, password, user_group) VALUES ('$username', '$password_hash', '$group')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function verify_username($username, $conn){
    $sql = "select * from User where user_name = '$username'";
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
        echo '<script>alert("Username is required");window.location.href="register.php";</script>';
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