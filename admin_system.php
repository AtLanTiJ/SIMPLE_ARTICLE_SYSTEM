<?php
session_start();
if ($_SESSION['group'] == 'admin') {
?>
    <!DOCTYPE html>
    <html lang="zh-CN">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理员系统</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="container">
            <div class="sidebar">
                <h3>管理员系统</h3>
                <ul>
                    <li><a href="javascript:void(0);" onclick="loadContent('dashboard.php', this)">仪表板</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('users.php', this)">用户管理</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('file_manger.php', this)">文件管理</a></li>
                    <li><a href="javascript:void(0);" onclick="loadContent('phpinfo.php', this)">phpinfo</a></li>
                </ul>
            </div>
            <div class="main-content">
                <div class="header">
                    <h2><?php echo $_SESSION['user_name']; ?>,欢迎来到管理员系统</h2>
                </div>
                <hr>
                <div id="content">
                    <!-- 内容将在这里加载 -->
                </div>
            </div>
        </div>

        <script>
            function loadContent(page) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("content").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", page, true);
                xhttp.send();
            }

            // Initialize the active class for the first link and load the dashboard on page load
            document.addEventListener('DOMContentLoaded', function() {
                var defaultPage = 'dashboard.php'; // 默认加载的页面
                var defaultLink = document.querySelector('.sidebar ul li a[href*="' + defaultPage + '"]');
                if (defaultLink) {
                    defaultLink.classList.add('active');
                    loadContent(defaultPage);
                }
            });
        </script>
    </body>

    </html>
<?php
} else {
    echo "<script>alert('You are not an admin!');window.location.href='admin.php';</script>";
}
