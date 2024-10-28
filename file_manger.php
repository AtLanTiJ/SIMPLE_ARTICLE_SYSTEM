<?php


# 分类指定目录下的文件和文件夹
function list_dir($path)
{
    if (strpos($path, 'article') === false) exit('参数错误');
    $path = '.' . $path;
    $result = ['dir' => [], 'file' => []];
    $f_list = scandir($path);
    foreach ($f_list as $f) {
        $f_path = $path . '\\' . trim($f);
        if (is_dir($f_path)) {
            if ($path == '.\article' && $f == '..' || $f == '.') continue;
            else $result['dir'][] = $f;
        } else {
            $result['file'][] = $f;
        }
    }
    return $result;
}


session_start();


if ($_SESSION['group'] != 'admin') exit('权限不足');


if (isset($_GET['a']) && isset($_GET['f'])) {
    $action = $_GET['a'];
    $f = $_GET['f'];
    switch ($action) {
        case 'del':
            if (file_exists($f)) {
                if (is_dir($f)) {
                    echo "<script>alert('目录不为空，无法删除')</script>";
                } else {
                    unlink($f);
                }
            }
            break;

        case 'edit':
            if (file_exists($f)) {
                $content = file_get_contents($f);
                echo "文件：$f<br>";
                echo "<form id='edit' name='edit' action='file_manger.php?a=save&path=" . urlencode($f) . "' method='post'>";
                echo "<textarea id='content' name='content' rows='10' cols='100' style='height: 250px; resize: vertical;'>" . htmlspecialchars($content) . "</textarea>";
                echo "<div class='button-container'>";
                echo "<input type='submit' name='submit' value='保存' class='form-btn'>";

                // 上级目录所在的页面
                $history_path = trim(substr($f, 0, strrpos($f, '\\')), '.');
                echo "<button type='button' onclick=\"loadContent('file_manger.php?path=" . urlencode($history_path) . "')\" class='form-btn'>返回</button>";
                echo "</form></div>";
            }
            exit();
            break;
    }
} elseif (@$_GET['a'] == 'save' && isset($_POST['content'])  && isset($_GET['path'])) {
    $f = $_GET['path'];
    $content = $_POST['content'];
    file_put_contents($f, $content);
    echo "<script>alert('保存成功');window.location.href='admin_system.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文件管理</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <table>
            <tr>
                <th>名称</th>
                <th>路径</th>
                <th>大小</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            <!-- 文件数据行 -->
            <?php
            $path = isset($_GET['path']) ? $_GET['path'] : "/article";

            # 格式化用户传递的路径
            $realPath = realpath('.' . $path);
            if ($realPath === false) exit('路径无效');
            $pathParts = explode('simple_comment', $realPath);
            $path = end($pathParts);

            $f_list = list_dir($path);
            foreach ($f_list['dir'] as $f) {
                echo "<tr>";
                echo "<td>$f</td>";
                echo "<td>$path\\$f</td>";
                echo "<td>目录</td>";
                echo "<td>" . date("Y-m-d H:i:s", filemtime("." . $path . '\\' . $f)) . "</td>";
                echo "<td><a href='javascript:void(0);' onclick=\"loadContent('file_manger.php?path=" . urlencode($path . '\\' . $f) . "', this)\">打开</a></td>";
                echo "</tr>";
            }
            foreach ($f_list['file'] as $f) {
                echo "<tr>";
                echo "<td>$f</td>";
                echo "<td>$path\\$f</td>";
                echo "<td>" . filesize("." . $path . '\\' . $f) . " KB</td>";
                echo "<td>" . date("Y-m-d H:i:s", filemtime("." . $path . '\\' . $f)) . "</td>";
                echo "<td><a href='javascript:void(0);' onclick=\"loadContent('file_manger.php?a=edit&f=" . urlencode('.' . $path . '\\' . $f) . "', this)\">编辑</a> |";
                echo "<a href='javascript:void(0);' onclick=\"loadContent('file_manger.php?a=del&f=" . urlencode('.' . $path . '\\' . $f) . "', this)\">删除</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>