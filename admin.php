<?php
require_once("utils.php");
session_start();
if (@$_SESSION['group'] == 'admin') {
    header("Location: admin_system.php");
    exit();
}elseif (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $password = $_POST['password'];

    # 查询用户组
    $sql = "select user_group from User where user_name = '$name'";
    $result = mysqli_query($conn, $sql);
    $group = mysqli_fetch_assoc($result)['user_group'];

    # 验证是否管理员组成员
    if ($group != 'admin') {
        echo "Invalid username or password";
    } else {
        # 调用函数验证密码，验证成功则进入管理员系统，否则输出错误信息
        if (passwd_verify($name, $password, $conn)) {
            # 登录成功，设置session

            $_SESSION['user_name'] = $name;
            $_SESSION['group'] = $group;
            header("Location: admin_system.php");
        } else {
            echo "Invalid username or password";
        }
    }
} else {
    require_once("admin.html");
}
